<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 to-purple-200 flex items-center justify-center min-h-screen">

    <div class="bg-white p-6 rounded-xl shadow-lg w-96">
        <h1 class="text-center text-2xl font-bold text-gray-700">QR Code Generator</h1>

        <form action="{{ route('qr-code.generate') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-2">
                <label for="text" class="block text-gray-600">Enter Text or URL:</label>
                <input type="text" name="text" id="text" class="w-full p-2 border rounded focus:ring-2 focus:ring-indigo-400" placeholder="Masukkan teks atau URL">
            </div>
            
            <div class="mb-2">
                <label for="size" class="block text-gray-600">QR Code Size:</label>
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
            <p class="font-semibold text-gray-700">Your QR Code:</p>
            <div class="mt-2">{!! $qrCode !!}</div>
        </div>
        @endif
    </div>

</body>
</html>
