<?php

namespace App\Infrastructure\Adapters;

use App\Domain\Entities\FileUpload;
use App\Domain\Entities\Provider;
use App\Domain\Interfaces\FileStorageAdapterInterface;
use App\Infrastructure\Exceptions\FileNotFoundInProviderException;
use App\Infrastructure\Exceptions\MicrosoftTokenExpiredException;
use Google\Service\DisplayVideo\IdFilter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class OneDriveFileStorageAdapter implements FileStorageAdapterInterface
{
    private string $clientId;
    private string $tenantId;
    private string $secret;
    private string $scope = "https://graph.microsoft.com/.default";
    private string $folderId;
    private string $driveId;
    private string $redirectUrl;
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
        $this->clientId = env("VAULT_{$this->provider->key}_ONEDRIVE_CLIENT_ID");
        $this->tenantId = env("VAULT_{$this->provider->key}_ONEDRIVE_TENANT_ID");
        $this->secret = env("VAULT_{$this->provider->key}_ONEDRIVE_CLIENT_SECRET");
        $this->folderId = env("VAULT_{$this->provider->key}_ONEDRIVE_FOLDER_ID");
        $this->driveId = env("VAULT_{$this->provider->key}_ONEDRIVE_DRIVER_ID");
        $this->redirectUrl = env("VAULT_{$this->provider->key}_ONEDRIVE_REDIRECT_URL");
    }

    public function upload(FileUpload $upload): void
    {
        $accessToken = $this->auth();

        $url = "https://graph.microsoft.com/v1.0/me/drive/root:/Boda/{$upload->completeName()}:/content";
        //$url = "https://graph.microsoft.com/v1.0/drives/{$this->driveId}/items/{$this->folderId}:/{$upload->completeName()}:/content";

        $response = Http::withToken($accessToken)
            ->withBody(
                is_resource($upload->content)
                    ? stream_get_contents($upload->content)
                    : $upload->content,
                $upload->mime->mime
            )
            ->put($url);

        if (! $response->successful()) {
            throw new \RuntimeException("Error al subir archivo a OneDrive: {$response->body()}");
        }

        //$json = $response->json();
        //return $json['id']; // el ID del archivo subido, lo guardás como `storagePath`
    }

    public function download(string $path): string
    {
        $accessToken = $this->auth();

        $idFile = $this->getFileId($path, $accessToken);

        if (!$idFile) {
            throw new FileNotFoundInProviderException();
        }

        return $this->downloadFile($idFile, $accessToken);
    }

    private function auth(): string
    {

        $cachedToken = Cache::get('access_token_' . strtolower($this->provider->accessKey));

        if ($cachedToken) {
            return $cachedToken;
        }

        $cacheRefreshToken = Cache::get('refresh_token_' . strtolower($this->provider->accessKey));
        if ($cacheRefreshToken) {

            $response = Http::asForm()->post('https://login.microsoftonline.com/common/oauth2/v2.0/token', [
                'client_id' => $this->clientId,
                'client_secret' => $this->secret,
                'grant_type' => 'refresh_token',
                'refresh_token' => $cacheRefreshToken,
                'redirect_uri' => $this->redirectUrl,
                'scope' => $this->scope,
            ]);

            if (!$response->successful()) {
                dd("Error renovando token", $response->body());
            }

            $data = $response->json();
            Cache::put('access_token_' . strtolower($this->provider->accessKey), $data['access_token'], now()->addSeconds(3300));

            if (isset($data['refresh_token'])) {
                Cache::put('refresh_token', $data['refresh_token'], now()->addDays(90));
            }

            return $data['access_token'];
        }

        throw new MicrosoftTokenExpiredException();
    }

    private function driveId(): string
    {
        $accessToken = $this->auth();

        $response = Http::withToken($accessToken)
        ->get('https://graph.microsoft.com/v1.0/drives');

        if (! $response->successful()) {
            throw new \RuntimeException("Error al obtener Drive ID: {$response->body()}");
        }

        $json = $response->json();

        if (!isset($json['value'][0]['id'])) {
            throw new \RuntimeException("No se encontró ningún Drive ID.");
        }

        dd($json);

        return $json['value'][0]['id'];
    }

    private function getFileId(string $path, string $accessToken): ?string
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
        ])->get("https://graph.microsoft.com/v1.0/me/drive/root:/Boda:/children?\$filter=name eq '{$path}'");

        if ($response->successful()) {
            $files = $response->json();
            if (!empty($files['value'])) {
                return $files['value'][0]['id'];
            }
        }

        return null;
    }

    public function downloadFile(string $fileId, string $accessToken): string
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
        ])->get("https://graph.microsoft.com/v1.0/me/drive/items/{$fileId}/content");

        if (!$response->successful()) {
            return "Archivo descargado correctamente.";

            return "Error al descargar el archivo: " . $response->body();
        }

        $fileContent = $response->body();

        return base64_encode($fileContent);
    }
}
