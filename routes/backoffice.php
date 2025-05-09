<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


Route::get('/onedrive/authorize/{providerKey}', function (string $providerKey) {
    $clientId = env("VAULT_{$providerKey}_ONEDRIVE_CLIENT_ID");
    $providerKey = strtoupper($providerKey);

    $authUrl = "https://login.microsoftonline.com/common/oauth2/v2.0/authorize?" . http_build_query([
        'client_id' => $clientId,
        'scope' => 'offline_access Files.ReadWrite',
        'response_type' => 'code',
        'redirect_uri' => env("VAULT_{$providerKey}_ONEDRIVE_REDIRECT_URL"),
        'response_mode' => 'query',
    ]);

    return redirect($authUrl);
});


Route::get('/microsoft/authorize/{providerKey}', function (string $providerKey) {
    $clientId = env("VAULT_{$providerKey}_ONEDRIVE_CLIENT_ID");
    $providerKey = strtoupper($providerKey);

    $authUrl = "https://login.microsoftonline.com/common/oauth2/v2.0/authorize?" . http_build_query([
        'client_id' => $clientId,
        'scope' => 'offline_access Files.ReadWrite',
        'response_type' => 'code',
        'redirect_uri' => env("VAULT_{$providerKey}_ONEDRIVE_REDIRECT_URL"),
        'response_mode' => 'query',
    ]);

    return response()->json([
        'url' => $authUrl,
    ]);
});

Route::get('/onedrive/callback/{providerKey}', function (Illuminate\Http\Request $request, string $providerKey) {
    $code = $request->get('code');
    $providerKey = strtoupper($providerKey);
    $response = Http::asForm()->post('https://login.microsoftonline.com/common/oauth2/v2.0/token', [
        'client_id' => env("VAULT_{$providerKey}_ONEDRIVE_CLIENT_ID"),
        'client_secret' => env("VAULT_{$providerKey}_ONEDRIVE_CLIENT_SECRET"),
        'grant_type' => 'authorization_code',
        'redirect_uri' => env("VAULT_{$providerKey}_ONEDRIVE_REDIRECT_URL"),
        'code' => $code,
    ]);

    if (!$response->successful()) {
        return response("Error al intercambiar el code: " . $response->body(), 500);
    }

    $tokens = $response->json();

    Cache::put('access_token_' . strtolower("ONEDRIVE1"), $tokens["access_token"], now()->addSeconds(3200));
    Cache::put('refresh_token_' . strtolower("ONEDRIVE1"), $tokens["refresh_token"], now()->addDays(90));
    //Cache::put('refresh_token_' . strtolower("ONEDRIVE1"), $tokens["refresh_token"], now()->addSeconds(7690600));

    return "¡Tokens guardados! 🎉";
});



