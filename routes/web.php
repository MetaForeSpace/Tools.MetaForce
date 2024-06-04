<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-qrcode/{url?}', [QrCodeController::class, 'generateQrCode']);

Route::get('/{key}/{id}', [BaseController::class, 'index']);

