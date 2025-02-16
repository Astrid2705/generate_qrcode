<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class QrCodeController extends Controller
{
    private $secretKey = "your-secret-key"; // Ganti dengan kunci rahasia yang lebih aman

    public function generate(Request $request)
    {
        $text = $request->input('text', 'https://example.com');
        $size = $request->input('size', 100);

        // Buat payload tanda tangan digital
        $payload = [
            'data' => $text,
            'timestamp' => time() // Menggunakan time() agar kompatibel di semua versi Laravel
        ];

        // Buat JWT tanda tangan
        $signature = JWT::encode($payload, $this->secretKey, 'HS256');

        // Gabungkan data dan tanda tangan dalam QR Code (Base64 untuk lebih ringkas)
        $qrData = base64_encode(json_encode([
            'text' => $text,
            'signature' => $signature
        ], JSON_UNESCAPED_SLASHES));

        // Generate QR Code dengan data digital signature
        $qrCode = QrCode::size($size)->generate($qrData);

        return view('qr-code', compact('qrCode'));
    }

    public function verify(Request $request)
    {
        $qrData = $request->input('qrData'); // Ambil data QR Code

        if (!$qrData) {
            return response()->json(['error' => 'Data tidak ditemukan'], 400);
        }

        // Decode base64 JSON
        $decodedData = json_decode(base64_decode($qrData), true);

        if (!isset($decodedData['signature'])) {
            return response()->json(['error' => 'Signature tidak ditemukan'], 400);
        }

        // Verifikasi tanda tangan
        try {
            $decodedSignature = JWT::decode($decodedData['signature'], new Key($this->secretKey, 'HS256'));

            return response()->json([
                'status' => 'valid',
                'data' => $decodedSignature->data,
                'timestamp' => $decodedSignature->timestamp
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Signature tidak valid'], 400);
        }
    }
}
