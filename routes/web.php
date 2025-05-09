<?php

use App\Infrastructure\Http\Controllers\DownloadFileController;
use App\Infrastructure\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;


Route::get('/onedrive/authorize', function () {
    $clientId = config('VAULT_MSODRIVE1_ONEDRIVE_CLIENT_ID');
    $redirectUri = urlencode("http://elementary-vault.test/api/callback");

    $authUrl = "https://login.microsoftonline.com/common/oauth2/v2.0/authorize?" . http_build_query([
        'client_id' => $clientId,
        'scope' => 'offline_access Files.ReadWrite',
        'response_type' => 'code',
        'redirect_uri' => $redirectUri,
        'response_mode' => 'query',
    ]);

    return redirect($authUrl);
});

Route::get('/onedrive/callback', function (Illuminate\Http\Request $request) {
    $code = $request->get('code');

    $response = Http::asForm()->post('https://login.microsoftonline.com/common/oauth2/v2.0/token', [
        'client_id' => config('VAULT_MSODRIVE1_ONEDRIVE_CLIENT_ID'),
        'client_secret' => config('VAULT_MSODRIVE1_ONEDRIVE_CLIENT_SECRET'),
        'grant_type' => 'authorization_code',
        'redirect_uri' => config('http://elementary-vault.test/api/callback'),
        'code' => $code,
    ]);

    if (!$response->successful()) {
        return response("Error al intercambiar el code: " . $response->body(), 500);
    }

    $tokens = $response->json();


    dd($tokens);

    return "¡Tokens guardados! 🎉";
});


Route::get('/files/{uuid}', DownloadFileController::class);
Route::post('/upload', UploadFileController::class);
