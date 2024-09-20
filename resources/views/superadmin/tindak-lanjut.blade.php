<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tindak Lanjut Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <x-superadmin.navsuper></x-superadmin.navsuper>
    <!-- Main Content -->
    <x-superadmin.headsuper></x-superadmin.headsuper>

    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Tindak Lanjut Pengaduan</h2>

                <!-- Menampilkan Detail Pengaduan -->
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

                <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status"
                            class="mt-1 block w-full bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="dilanjutkan" {{ $pengaduan->status == 'dilanjutkan' ? 'selected' : '' }}>
                                Dilanjutkan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                        <textarea id="catatan" name="catatan" rows="4"
                            class="mt-1 block w-full bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"></textarea>
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
