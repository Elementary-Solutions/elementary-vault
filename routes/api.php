<?php

use App\Infrastructure\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/upload', UploadFileController::class);
