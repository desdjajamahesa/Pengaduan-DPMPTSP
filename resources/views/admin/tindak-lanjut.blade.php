<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tindak Lanjut Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <x-admin.navadmin></x-admin.navadmin>
    <!-- Main Content -->
    <x-admin.headadmin></x-admin.headadmin>

    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Tindak Lanjut Pengaduan</h2>

                @if (session('success'))
                    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Menampilkan detail aduan -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-700">Detail Pengaduan</h3>
                    <div class="mt-2 bg-gray-50 border border-gray-300 rounded-md p-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600">Judul Pengaduan</label>
                            <p class="mt-1">{{ $pengaduan->judul_pengaduan }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600">Tanggal Pengaduan</label>
                            <p class="mt-1">{{ $pengaduan->tanggal_pengaduan }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600">Lokasi Kejadian</label>
                            <p class="mt-1">{{ $pengaduan->lokasi_kejadian }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600">Alamat</label>
                            <p class="mt-1">{{ $pengaduan->alamat }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600">Isi Pengaduan</label>
                            <p class="mt-1">{{ $pengaduan->isi_pengaduan }}</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-700">Status Pengaduan</h3>
                        <div class="mt-2">
                            <td>
                                @if ($pengaduan->status == 'belum_proses')
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full">Belum Diproses</span>
                                @elseif ($pengaduan->status == 'proses')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full">Proses</span>
                                @elseif ($pengaduan->status == 'selesai')
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full">Selesai</span>
                                @elseif ($pengaduan->status == 'dilanjutkan')
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full">Dilanjutkan</span>
                                @endif
                            </td>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status"
                            class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="belum_proses" {{ $pengaduan->status == 'belum_proses' ? 'selected' : '' }}>
                                Belum Diproses</option>
                            <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="dilanjutkan" {{ $pengaduan->status == 'dilanjutkan' ? 'selected' : '' }}>
                                Dilanjutkan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="tindaklanjut" class="block text-sm font-medium text-gray-700">Hasil Tindak
                            Lanjut</label>
                        <textarea id="tindaklanjut" name="tindaklanjut" rows="4"
                            class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ old('tindaklanjut', $pengaduan->tindaklanjut ?? '') }}</textarea>
                    </div>
                    <div>
                        <label for="file_pendukung" class="block text-gray-700 font-medium mb-2">Unggah File
                            Pendukung</label>
                        <input type="file" name="file_pendukung" id="file_pendukung"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                            accept=".pdf,.jpg,.jpeg,.png,.docx,.xlsx" required>
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
