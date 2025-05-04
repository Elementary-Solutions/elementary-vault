<?php

return [

    'api_key'          => env('VAULT_API_KEY'),
    'default_provider' => env('VAULT_PROVIDER_DEFAULT', ''),

    'adapters' => [

        'local' => [
            'disk' => env('VAULT_LOCAL_DISK', 'local'),
            'root' => env('VAULT_LOCAL_ROOT', storage_path('app')),
        ],

        's3' => [
            'key' => env('VAULT_S3_KEY'),
            'secret' => env('VAULT_S3_SECRET'),
            'region' => env('VAULT_S3_REGION'),
            'bucket' => env('VAULT_S3_BUCKET'),
            'endpoint' => env('VAULT_S3_ENDPOINT'),
        ],

        'google_drive' => [
            'client_id' => env('VAULT_GDRIVE_CLIENT_ID'),
            'client_secret' => env('VAULT_GDRIVE_CLIENT_SECRET'),
            'refresh_token' => env('VAULT_GDRIVE_REFRESH_TOKEN'),
            'folder_id' => env('VAULT_GDRIVE_FOLDER_ID'),
        ],

        'onedrive' => [
            'client_id' => env('VAULT_ONEDRIVE_CLIENT_ID'),
            'client_secret' => env('VAULT_ONEDRIVE_CLIENT_SECRET'),
            'refresh_token' => env('VAULT_ONEDRIVE_REFRESH_TOKEN'),
            'drive_id' => env('VAULT_ONEDRIVE_DRIVE_ID'),
        ],
    ],
];
