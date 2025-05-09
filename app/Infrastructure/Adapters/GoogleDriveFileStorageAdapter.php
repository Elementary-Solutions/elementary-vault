<?php

namespace App\Infrastructure\Adapters;

use App\Domain\Entities\FileUpload;
use App\Domain\Entities\Provider;
use App\Domain\Interfaces\FileStorageAdapterInterface;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use RuntimeException;

class GoogleDriveFileStorageAdapter implements FileStorageAdapterInterface
{
    private Drive $drive;
    private string $folderId;

    public function __construct(Provider $provider)
    {
        $client = new Client();
        $jsonConfig = base64_decode(env("VAULT_{$provider->key}_GOOGLE_CREDENTIALS_PATH"));
        $client->setAuthConfig(json_decode($jsonConfig, true));
        $client->addScope(Drive::DRIVE);
        $this->drive = new Drive($client);

        $this->folderId = env("VAULT_{$provider->key}_GOOGLE_FOLDER_ID");
    }

    public function upload(FileUpload $upload): void
    {
        $fileMetadata = new DriveFile([
            'name' => $upload->completeName(),
            'parents' => [$this->folderId]
        ]);

        $content = is_resource($upload->content)
            ? stream_get_contents($upload->content)
            : $upload->content;

        $createdFile = $this->drive->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $upload->mime->mime,
            'uploadType' => 'multipart',
        ]);

        if (!isset($createdFile->id)) {
            throw new RuntimeException('No se pudo subir el archivo a Google Drive.');
        }
    }

    public function download(string $path): string
    {
        $query = sprintf(
            "name = '%s' and '%s' in parents and trashed = false",
            addslashes($path),
            $this->folderId // carpeta compartida
        );

        $files = $this->drive->files->listFiles([
            'q' => $query,
            'fields' => 'files(id, name)',
            'spaces' => 'drive',
        ]);

        if (empty($files->files)) {
            throw new \RuntimeException("Archivo '{$path}' no encontrado en carpeta.");
        }

        $fileId = $files->files[0]->id;

        $response = $this->drive->files->get($fileId, ['alt' => 'media']);

        $content = $response->getBody()->getContents();
        return base64_encode($content);
    }
}
