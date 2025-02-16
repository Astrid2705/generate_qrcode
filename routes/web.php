<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\SignatureController;

Route::get('/qr-code', function () {
    return view('qr-code');
});

Route::post('/generate-qr-code', [QrCodeController::class, 'generate'])->name('qr-code.generate');

Route::post('/upload-signature', [SignatureController::class, 'uploadSignature'])->name('upload.signature');
