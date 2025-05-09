<?php

use App\Infrastructure\Http\Controllers\DownloadFileController;
use App\Infrastructure\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;


// RUTAS DE LA API

Route::get('/files/{uuid}', DownloadFileController::class);
Route::post('/upload', UploadFileController::class);
