<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Detail Pengaduan</title>
</head>

<body class="bg-gray-100">
    <x-user.navbar></x-user.navbar>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white">
                <h1 class="text-2xl font-bold">{{ $pengaduan->judul_pengaduan }}</h1>
                <span
                    class="inline-block px-3 py-1 mt-2 text-xs font-semibold rounded-full
                    @if ($pengaduan->status == 'belum_proses') bg-red-100 text-red-800
                    @elseif($pengaduan->status == 'proses') bg-yellow-100 text-yellow-800
                    @elseif($pengaduan->status == 'selesai') bg-green-100 text-green-800
                    @elseif($pengaduan->status == 'dilanjutkan') bg-blue-100 text-blue-800
                    @elseif($pengaduan->status == 'dibatalkan') bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst(str_replace('_', ' ', $pengaduan->status)) }}
                </span>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Pengaduan</h2>
                        <div class="space-y-2">
                            <p class="text-gray-600"><span class="font-medium w-1/3 inline-block">Tanggal:</span>
                                {{ $pengaduan->tanggal_pengaduan }}</p>
                            <p class="text-gray-600"><span class="font-medium w-1/3 inline-block">Lokasi
                                    Kejadian:</span> {{ $pengaduan->lokasi_kejadian }}</p>
                            <p class="text-gray-600"><span class="font-medium w-1/3 inline-block">Alamat:</span>
                                {{ $pengaduan->alamat }}</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Informasi Pelapor</h2>
                        <div class="space-y-2">
                            <p class="text-gray-600"><span class="font-medium w-1/3 inline-block">Nama:</span>
                                {{ $pengaduan->user->name }}</p>
                            <p class="text-gray-600"><span class="font-medium w-1/3 inline-block">Email:</span>
                                {{ $pengaduan->user->email }}</p>
                            @if ($pengaduan->user->telephone)
                                <p class="text-gray-600"><span class="font-medium w-1/3 inline-block">Telepon:</span>
                                    {{ $pengaduan->user->telephone }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg shadow">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Isi Pengaduan</h2>
                    <p class="text-gray-600">{{ $pengaduan->isi_pengaduan }}</p>
                </div>

                @if ($pengaduan->file_pendukung)
                    <div class="bg-gray-50 p-4 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">File Pendukung</h2>
                        <a href="{{ asset('storage/' . $pengaduan->file_pendukung) }}" target="_blank"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            <i class="fas fa-file-download mr-2"></i> Unduh File
                        </a>
                    </div>
                @endif

                @if ($pengaduan->tindaklanjut)
                    <div class="bg-gray-50 p-4 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">Tindak Lanjut</h2>
                        <p class="text-gray-600">{{ $pengaduan->tindaklanjut }}</p>
                    </div>
                @endif

                <div class="flex justify-between items-center mt-8">
                    <a href="{{ route('pengaduan.home') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>

                    @if ($pengaduan->status != 'dibatalkan')
                        <form action="{{ route('pengaduan.batalkan', $pengaduan->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition flex items-center"
                                onclick="return confirm('Apakah Anda yakin ingin membatalkan pengaduan ini?')">
                                <i class="fas fa-ban mr-2"></i> Batalkan Pengaduan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>

</html>
