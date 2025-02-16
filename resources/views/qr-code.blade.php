<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator & Digital Signature</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-purple-200 flex flex-col items-center justify-center min-h-screen p-6">

    <!-- Tanda Tangan Digital -->
    <div class="w-full max-w-md bg-white p-6 rounded-xl shadow-md text-center mb-6">
        <h2 class="text-xl font-bold mb-4">Tanda Tangan Digital</h2>
        <p class="text-gray-600">Scan QR Code di bawah untuk verifikasi tanda tangan digital:</p>
        <div class="mt-4">{!! $qrCode ?? '' !!}</div>
    </div>

    <!-- Form Upload Tanda Tangan -->
    <div class="bg-white p-6 rounded-xl shadow-lg w-96 mb-6">
        <h1 class="text-center text-2xl font-bold text-gray-700">Upload Tanda Tangan</h1>

        <form action="{{ route('upload.signature') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="mb-2">
                <label for="signature" class="block text-gray-600">Pilih Gambar Tanda Tangan:</label>
                <input type="file" name="signature" id="signature" accept="image/png, image/jpeg" required 
                    class="w-full p-2 border rounded focus:ring-2 focus:ring-indigo-400">
            </div>

            <button type="submit" class="bg-indigo-500 text-white w-full py-2 rounded hover:bg-indigo-400 transition">
                Upload Tanda Tangan
            </button>
        </form>

        @if(session('signatureUrl'))
        <div class="mt-6 flex flex-col items-center p-4 bg-gray-100 rounded-lg shadow">
            <p class="font-semibold text-gray-700">Tanda Tangan Digital:</p>
            <img src="{{ session('signatureUrl') }}" alt="Tanda Tangan Digital" class="mt-2 w-40 h-auto border rounded">
        </div>
        @endif
    </div>

    <!-- QR Code Generator -->
    <div class="bg-white p-6 rounded-xl shadow-lg w-96">
        <h1 class="text-center text-2xl font-bold text-gray-700">QR Code Generator</h1>

        <form action="{{ route('qr-code.generate') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-2">
                <label for="text" class="block text-gray-600">Masukkan Teks atau URL:</label>
                <input type="text" name="text" id="text" class="w-full p-2 border rounded focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan teks atau URL">
            </div>
            
            <div class="mb-2">
                <label for="size" class="block text-gray-600">Ukuran QR Code:</label>
                <select name="size" id="size" class="w-full p-2 border rounded focus:ring-2 focus:ring-indigo-400">
                    <option value="100">100x100</option>
                    <option value="200">200x200</option>
                    <option value="300">300x300</option>
                </select>
            </div>

            <button type="submit" class="bg-indigo-500 text-white w-full py-2 rounded hover:bg-indigo-400 transition">
                Generate QR Code
            </button>
        </form>

        @if(isset($qrCode))
        <div class="mt-6 flex flex-col items-center p-4 bg-gray-100 rounded-lg shadow">
            <p class="font-semibold text-gray-700">Hasil QR Code:</p>
            <div class="mt-2">{!! $qrCode !!}</div>
        </div>
        @endif
    </div>

</body>
</html>
