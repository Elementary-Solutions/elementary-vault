<?php

use App\Infrastructure\Http\Controllers\DownloadFileController;
use App\Infrastructure\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;


Route::get('/files/{uuid}', DownloadFileController::class);
Route::post('/upload', UploadFileController::class);
