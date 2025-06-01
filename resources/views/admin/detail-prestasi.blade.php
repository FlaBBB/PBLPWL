<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Prestasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[500px]">
        <h2 class="text-2xl font-bold mb-6">Detail Prestasi</h2>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama Lomba</label>
                    <input type="text" value="Hackaton Merdeka Jawa" readonly class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50 text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <input type="text" value="Cyber Security" readonly class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50 text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Tanggal Lomba</label>
                    <input type="text" value="23 Maret 2021" readonly class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50 text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Penyelenggara</label>
                    <input type="text" value="Institut Teknologi Jawa Pusat" readonly class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50 text-sm">
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Tingkat</label>
                    <input type="text" value="Nasional" readonly class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50 text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Ranking</label>
                    <input type="text" value="Juara 1" readonly class="mt-1 block w-full p-2 border border-gray-300 rounded-md bg-gray-50 text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Sertifikat Lomba</label>
                    <div class="mt-1 flex justify-center">
                        <img src="https://marketplace.canva.com/EAE7tTrZPDg/3/0/1600w/canva-white-blue-elegant-sertifikat-penghargaan-pencapaian-certificate-landscape-NY51ET844j8.jpg" alt="Sertifikat" class="border border-gray-300 rounded-md max-w-[200px]">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-6">
            <p class="text-sm text-gray-500 mb-2">Catatan: Tulis pesan atau catatan</p>
            <input type="text" placeholder="Tulisan pesan atau catatan" class="w-full p-2 border border-gray-300 rounded-md text-sm">
        </div>
        <div class="mt-6 flex justify-end space-x-4">
            <button class="px-4 py-2 border-2 border-red-500 text-red-500 rounded-md hover:bg-red-50 flex items-center space-x-2">
                <span class="text-xl">×</span>
                <span>Tolak</span>
            </button>
            <button class="px-4 py-2 border-2 border-red-500 text-red-500 rounded-md hover:bg-red-50 flex items-center space-x-2">
                <span class="text-xl">×</span>
                <span>Revisi</span>
            </button>
            <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 flex items-center space-x-2">
                <span class="text-xl">✓</span>
                <span>Verifikasi</span>
            </button>
        </div>
    </div>
</body>
</html>