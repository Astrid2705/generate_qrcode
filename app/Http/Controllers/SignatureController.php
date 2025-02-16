<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SignatureController extends Controller
{
    public function uploadSignature(Request $request)
    {
        $request->validate([
            'signature' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        // Simpan file ke storage/app/public/signatures/
        $path = $request->file('signature')->store('public/signatures');

        // Ambil URL file yang bisa diakses publik
        $signatureUrl = Storage::url($path);

        return back()->with('success', 'Tanda tangan berhasil diunggah!')->with('signatureUrl', $signatureUrl);
    }
}
