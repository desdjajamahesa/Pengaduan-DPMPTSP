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
                        <!-- ... kode detail pengaduan lainnya tetap sama ... -->


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

                        <!-- Tambahkan bagian untuk menampilkan file pendukung yang ada -->
                        @if ($pengaduan->file_pendukung)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600">File Pendukung Saat
                                    Ini</label>
                                <div class="mt-2 flex items-center space-x-4">
                                    <span class="text-sm text-gray-500">
                                        @php
                                            $fileName = basename($pengaduan->file_pendukung);
                                            $extension = pathinfo($fileName, PATHINFO_EXTENSION);

                                            // Menentukan ikon berdasarkan ekstensi file
                                            $iconClass = match (strtolower($extension)) {
                                                'pdf' => 'fas fa-file-pdf text-red-500',
                                                'doc', 'docx' => 'fas fa-file-word text-blue-500',
                                                'xls', 'xlsx' => 'fas fa-file-excel text-green-500',
                                                'jpg', 'jpeg', 'png' => 'fas fa-file-image text-purple-500',
                                                default => 'fas fa-file text-gray-500',
                                            };
                                        @endphp
                                        <i class="{{ $iconClass }} mr-2"></i>
                                        {{ $fileName }}
                                    </span>

                                    <a href="{{ route('pengaduan.download', $pengaduan->id) }}"
                                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <i class="fas fa-download mr-1"></i>
                                        Unduh
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <form action="{{ route('superadmin.pengaduan.update', $pengaduan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-700">Status Pengaduan</h3>
                        <div class="mt-2">
                            <td>
                                @if ($pengaduan->status == 'belum_proses')
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full">Belum
                                        Diproses</span>
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
                        <label for="kesesuaian_sop" class="block text-sm font-medium text-gray-700">Kesesuaian
                            SOP</label>
                        <select id="kesesuaian_sop" name="kesesuaian_sop"
                            class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="sesuai dengan sop"
                                {{ $pengaduan->kesesuaian_sop == 'sesuai dengan sop' ? 'selected' : '' }}>
                                Sesuai dengan SOP</option>
                            <option value="melebihi sop"
                                {{ $pengaduan->kesesuaian_sop == 'melebihi sop' ? 'selected' : '' }}>
                                Melebihi SOP</option>
                            <option value="lebih cepat dari sop"
                                {{ $pengaduan->kesesuaian_sop == 'lebih cepat dari sop' ? 'selected' : '' }}>
                                Lebih Cepat dari SOP</option>
                        </select>
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
                        <label for="file_balasan" class="block text-sm font-medium text-gray-700">Unggah
                            File
                            Pendukung</label>
                        <input type="file" name="file_balasan" id="file_balasan" required
                            accept=".pdf,.jpg,.jpeg,.png,.docx,.xlsx"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</body>

</html>
