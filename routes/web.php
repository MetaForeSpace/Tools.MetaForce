<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Web3Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-qrcode/{url?}', [QrCodeController::class, 'generateQrCode']);
Route::get('/web3', [Web3Controller::class, 'index']);

Route::get('/{key}/{id}', [BaseController::class, 'index']);

