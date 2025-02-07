<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;

Route::get('/qr-code', function () {
    return view('qr-code');
});

Route::post('/generate-qr-code', [QrCodeController::class, 'generate'])->name('qr-code.generate');


