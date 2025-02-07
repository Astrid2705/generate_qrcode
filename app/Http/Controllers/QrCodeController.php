<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function generate(Request $request)
    {
        $text = $request->input('text', 'https://example.com'); // Default to example.com
        $size = $request->input('size', 100);

        $qrCode = QrCode::size($size)
                           ->generate($text);

        return view('qr-code', compact('qrCode'));
    }
}