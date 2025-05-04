<?php

namespace Database\Seeders\Default;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileMimeTypeSeeder extends Seeder
{
    public function run(): void
    {
        $mimeTypes = [

            ['type_id' => 14, 'mime' => 'unknown', 'extension' => '', 'description' => 'Archivo no identificado'],

            // type_id = 1 → image
            ['type_id' => 1, 'mime' => 'image/jpeg',    'extension' => 'jpg',  'description' => 'Imagen JPEG'],
            ['type_id' => 1, 'mime' => 'image/png',     'extension' => 'png',  'description' => 'Imagen PNG'],
            ['type_id' => 1, 'mime' => 'image/gif',     'extension' => 'gif',  'description' => 'Imagen GIF animada'],
            ['type_id' => 1, 'mime' => 'image/webp',    'extension' => 'webp', 'description' => 'Imagen WebP'],
            ['type_id' => 1, 'mime' => 'image/bmp',     'extension' => 'bmp',  'description' => 'Imagen BMP'],
            ['type_id' => 1, 'mime' => 'image/svg+xml', 'extension' => 'svg',  'description' => 'Gráfico vectorial SVG'],
            ['type_id' => 1, 'mime' => 'image/x-icon',  'extension' => 'ico',  'description' => 'Icono de aplicación'],
            ['type_id' => 1, 'mime' => 'image/tiff',    'extension' => 'tiff', 'description' => 'Imagen TIFF'],
            ['type_id' => 1, 'mime' => 'image/heif',    'extension' => 'heif', 'description' => 'Imagen HEIF'],
            ['type_id' => 1, 'mime' => 'image/heic',    'extension' => 'heic', 'description' => 'Imagen HEIC'],

            // type_id = 2 → video
            ['type_id' => 2, 'mime' => 'video/mp4',         'extension' => 'mp4',  'description' => 'Video MP4'],
            ['type_id' => 2, 'mime' => 'video/x-msvideo',   'extension' => 'avi',  'description' => 'Video AVI'],
            ['type_id' => 2, 'mime' => 'video/quicktime',   'extension' => 'mov',  'description' => 'Video QuickTime'],
            ['type_id' => 2, 'mime' => 'video/x-matroska',  'extension' => 'mkv',  'description' => 'Video MKV'],
            ['type_id' => 2, 'mime' => 'video/webm',        'extension' => 'webm', 'description' => 'Video WebM'],
            ['type_id' => 2, 'mime' => 'video/mpeg',        'extension' => 'mpeg', 'description' => 'Video MPEG'],
            ['type_id' => 2, 'mime' => 'video/3gpp',        'extension' => '3gp',  'description' => 'Video 3GP'],
            ['type_id' => 2, 'mime' => 'video/3gpp2',       'extension' => '3g2',  'description' => 'Video 3G2'],
            ['type_id' => 2, 'mime' => 'video/ogg',         'extension' => 'ogv',  'description' => 'Video Ogg'],
            ['type_id' => 2, 'mime' => 'video/x-flv',       'extension' => 'flv',  'description' => 'Video Flash'],
            ['type_id' => 2, 'mime' => 'video/x-ms-wmv',    'extension' => 'wmv',  'description' => 'Video WMV'],
            ['type_id' => 2, 'mime' => 'video/x-ms-asf',    'extension' => 'asf',  'description' => 'Video ASF'],
            ['type_id' => 2, 'mime' => 'video/x-m4v',       'extension' => 'm4v',  'description' => 'Video M4V'],
            ['type_id' => 2, 'mime' => 'video/mj2',         'extension' => 'mj2',  'description' => 'Video Motion JPEG 2000'],

            // type_id = 3 → audio
            ['type_id' => 3, 'mime' => 'audio/mpeg',     'extension' => 'mp3',  'description' => 'Audio MP3'],
            ['type_id' => 3, 'mime' => 'audio/ogg',      'extension' => 'ogg',  'description' => 'Audio Ogg'],
            ['type_id' => 3, 'mime' => 'audio/wav',      'extension' => 'wav',  'description' => 'Audio WAV'],
            ['type_id' => 3, 'mime' => 'audio/webm',     'extension' => 'weba', 'description' => 'Audio WebM'],
            ['type_id' => 3, 'mime' => 'audio/aac',      'extension' => 'aac',  'description' => 'Audio AAC'],
            ['type_id' => 3, 'mime' => 'audio/x-ms-wma', 'extension' => 'wma',  'description' => 'Audio WMA'],
            ['type_id' => 3, 'mime' => 'audio/flac',     'extension' => 'flac', 'description' => 'Audio FLAC'],
            ['type_id' => 3, 'mime' => 'audio/midi',     'extension' => 'midi', 'description' => 'Audio MIDI'],

            // type_id = 4 → document
            ['type_id' => 4, 'mime' => 'application/pdf',     'extension' => 'pdf',  'description' => 'Documento PDF'],
            ['type_id' => 4, 'mime' => 'application/msword',  'extension' => 'doc',  'description' => 'Documento Word'],
            ['type_id' => 4, 'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'extension' => 'docx', 'description' => 'Documento Word DOCX'],
            ['type_id' => 4, 'mime' => 'text/plain',          'extension' => 'txt',  'description' => 'Texto plano'],

            // type_id = 5 → spreadsheet
            ['type_id' => 5, 'mime' => 'application/vnd.ms-excel', 'extension' => 'xls',  'description' => 'Planilla Excel'],
            ['type_id' => 5, 'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'extension' => 'xlsx', 'description' => 'Planilla Excel XLSX'],
            ['type_id' => 5, 'mime' => 'text/csv', 'extension' => 'csv', 'description' => 'Valores separados por coma'],

            // type_id = 6 → presentation
            ['type_id' => 6, 'mime' => 'application/vnd.ms-powerpoint', 'extension' => 'ppt', 'description' => 'Presentación PowerPoint'],
            ['type_id' => 6, 'mime' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'extension' => 'pptx', 'description' => 'Presentación PowerPoint PPTX'],

            // type_id = 7 → code
            ['type_id' => 7, 'mime' => 'application/x-httpd-php', 'extension' => 'php', 'description' => 'Código PHP'],
            ['type_id' => 7, 'mime' => 'application/javascript', 'extension' => 'js', 'description' => 'Código JavaScript'],
            ['type_id' => 7, 'mime' => 'text/html', 'extension' => 'html', 'description' => 'HTML'],

            // type_id = 8 → font
            ['type_id' => 8, 'mime' => 'font/woff', 'extension' => 'woff', 'description' => 'Fuente WOFF'],
            ['type_id' => 8, 'mime' => 'font/woff2', 'extension' => 'woff2', 'description' => 'Fuente WOFF2'],
            ['type_id' => 8, 'mime' => 'application/x-font-ttf', 'extension' => 'ttf', 'description' => 'Fuente TrueType'],

            // type_id = 9 → model
            ['type_id' => 9, 'mime' => 'model/gltf+json', 'extension' => 'gltf', 'description' => 'Modelo 3D glTF'],
            ['type_id' => 9, 'mime' => 'model/3mf', 'extension' => '3mf', 'description' => 'Modelo 3D 3MF'],

            // type_id = 10 → data
            ['type_id' => 10, 'mime' => 'application/json', 'extension' => 'json', 'description' => 'Archivo JSON'],
            ['type_id' => 10, 'mime' => 'application/xml', 'extension' => 'xml', 'description' => 'Archivo XML'],
            ['type_id' => 10, 'mime' => 'application/yaml', 'extension' => 'yaml', 'description' => 'Archivo YAML'],

            // type_id = 11 → script
            ['type_id' => 11, 'mime' => 'application/x-sh', 'extension' => 'sh', 'description' => 'Script Bash'],
            ['type_id' => 11, 'mime' => 'text/x-python', 'extension' => 'py', 'description' => 'Script Python'],

            // type_id = 12 → compressed
            ['type_id' => 12, 'mime' => 'application/zip', 'extension' => 'zip', 'description' => 'Archivo ZIP'],
            ['type_id' => 12, 'mime' => 'application/x-rar-compressed', 'extension' => 'rar', 'description' => 'Archivo RAR'],
            ['type_id' => 12, 'mime' => 'application/x-7z-compressed', 'extension' => '7z', 'description' => 'Archivo 7-Zip'],
            ['type_id' => 12, 'mime' => 'application/x-tar', 'extension' => 'tar', 'description' => 'Archivo TAR'],

            // type_id = 13 → executable
            ['type_id' => 13, 'mime' => 'application/x-msdownload', 'extension' => 'exe', 'description' => 'Archivo ejecutable EXE'],
            ['type_id' => 13, 'mime' => 'application/vnd.android.package-archive', 'extension' => 'apk', 'description' => 'Instalador Android APK'],

            // type_id = 14 → other
            ['type_id' => 14, 'mime' => 'application/octet-stream', 'extension' => 'bin', 'description' => 'Archivo binario genérico'],
        ];

        DB::table('file_mime_types')->insert($mimeTypes);
        DB::table('file_mime_types')->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    }
}
