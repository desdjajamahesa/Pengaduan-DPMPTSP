<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script defer>
        function confirmSubmission(event) {
            event.preventDefault(); // Prevent form from submitting

            const form = event.target;

            // Collect form data
            const formData = new FormData(form);
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            // Display confirmation message
            if (confirm(
                    `Apakah Anda yakin ingin mengirimkan pengaduan ini?\n\n` +
                    `Judul Pengaduan: ${data.judul_pengaduan}\n` +
                    `Tanggal Pengaduan: ${data.tanggal_pengaduan}\n` +
                    `Lokasi Kejadian: ${data.lokasi_kejadian}\n` +
                    `Alamat: ${data.alamat}\n` +
                    `Isi Pengaduan: ${data.isi_pengaduan}`
                )) {
                form.submit(); // Submit the form if confirmed
            }
        }
    </script>
    <title>Document</title>
</head>

<body class="bg-gray-50">
    <x-user.navbar></x-user.navbar>

    <div class="container mx-auto px-4 py-16">
        <!-- Page Title -->
        <section id="stat" class="text-center py-8 mb-32">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Statistik Pengaduan DPMPTSP</h2>
            <p class="text-gray-600 mb-8">Lihat statistik pelapor dan status pengaduan yang diterima.</p>

            <!-- Cards Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Pelapor Card -->
                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <h4 class="text-xl font-semibold text-gray-700">Pelapor</h4>
                    <p class="text-gray-500 mt-4">Jumlah pengaduan yang diajukan oleh masyarakat.</p>
                </div>
                <!-- Status Pengaduan Card -->
                <div class="bg-white rounded-lg shadow-md p-8 text-center">
                    <h4 class="text-xl font-semibold text-gray-700">Status Pengaduan</h4>
                    <p class="text-gray-500 mt-4">Proses pengaduan yang sudah dilakukan.</p>
                </div>
            </div>
        </section>

        <!-- SOP Section -->
        <section id="sop">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Alur Pengaduan</h2>
                        <div class="w-24 h-1 bg-blue-500 mx-auto"></div>
                    </div>

                    @php
                        $sops = App\Models\Sop::all();
                        $currentIndex = request()->query('sop_index', 0);
                        $currentSop = $sops[$currentIndex] ?? null;
                    @endphp

                    @if ($currentSop)
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                            <div class="p-8">
                                <div class="relative w-full" style="height: 70vh;">
                                    <img src="{{ asset('storage/' . $currentSop->image_url) }}"
                                        alt="Alur Pengaduan {{ $currentIndex + 1 }}"
                                        class="absolute inset-0 w-full h-full object-contain rounded-lg cursor-pointer"
                                        onclick="openFullscreen(this)">
                                </div>
                                <div class="mt-6 flex justify-between items-center">
                                    <a href="{{ route('sop.index', ['sop_index' => max(0, $currentIndex - 1)]) }}"
                                        class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-full hover:bg-gray-300 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 {{ $currentIndex == 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $currentIndex == 0 ? 'disabled' : '' }}>
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                        Sebelumnya
                                    </a>
                                    <span class="text-gray-600">{{ $currentIndex + 1 }} dari {{ $sops->count() }}</span>
                                    <a href="{{ route('sop.index', ['sop_index' => min($sops->count() - 1, $currentIndex + 1)]) }}"
                                        class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-full hover:bg-gray-300 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 {{ $currentIndex == $sops->count() - 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $currentIndex == $sops->count() - 1 ? 'disabled' : '' }}>
                                        Selanjutnya
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="mt-6 flex justify-center space-x-4">
                                    <a href="{{ asset('storage/' . $currentSop->image_url) }}" target="_blank"
                                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Lihat Gambar Penuh
                                    </a>
                                    <a href="{{ asset('storage/' . $currentSop->image_url) }}" download
                                        class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                            </path>
                                        </svg>
                                        Unduh SOP
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                            <div class="p-8">
                                <div class="text-center py-16">
                                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    <p class="text-xl text-gray-600 mb-2">Tidak ada SOP yang diunggah.</p>
                                    <p class="text-gray-500">Silakan hubungi administrator untuk informasi lebih lanjut.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </section>

        <script>
            function openFullscreen(img) {
                if (img.requestFullscreen) {
                    img.requestFullscreen();
                } else if (img.webkitRequestFullscreen) {
                    /* Safari */
                    img.webkitRequestFullscreen();
                } else if (img.msRequestFullscreen) {
                    /* IE11 */
                    img.msRequestFullscreen();
                }
            }
        </script>
    </div>
    <!-- Mode Tabs: Pengaduan & Konsultasi -->
    <div class="container mx-auto px-4 pb-[300px]" id="form">
        <form action="{{ route('pengaduan.store') }}" method="POST" onsubmit="confirmSubmission(event)"
            class="space-y-6 mt-20 mb-10">
            @csrf
            <div x-data="{ mode: 'pengaduan' }">
                <div class="flex justify-center mb-8">
                    <button @click="mode = 'pengaduan'" type="button"
                        :class="mode === 'pengaduan' ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700'"
                        class="px-4 py-2 rounded-l-lg focus:outline-none hover:bg-red-600">Pengaduan</button>
                    <button @click="mode = 'History_Pengaduan'" type="button"
                        :class="mode === 'History_Pengaduan' ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700'"
                        class="px-4 py-2  focus:outline-none hover:bg-red-600">History
                        Pengaduan</button>
                    <button @click="mode = 'konsultasi'" type="button"
                        :class="mode === 'konsultasi' ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700'"
                        class="px-4 py-2 rounded-r-lg focus:outline-none hover:bg-red-600">Konsultasi</button>
                </div>

                <!-- Pengaduan Form Section -->
                <section x-show="mode === 'pengaduan'"
                    class="max-w-4xl mx-auto bg-white shadow-2xl rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white">
                        <h2 class="text-3xl font-bold text-center">Sampaikan Laporan Anda</h2>
                        <p class="text-center mt-2 text-blue-100">Kami siap mendengar dan menindaklanjuti laporan
                            Anda
                        </p>
                    </div>

                    <div class="p-8">
                        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data"
                            onsubmit="return confirmSubmission(event)" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700">Nama Pengguna</label>
                                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                    <p class="mt-1 text-lg font-semibold text-gray-900">
                                        {{ Auth::user()->telephone }}
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label for="judul_pengaduan" class="block text-sm font-medium text-gray-700">Judul
                                    Pengaduan</label>
                                <input type="text" name="judul_pengaduan" id="judul_pengaduan" required
                                    class="mt-2 block w-full h-8 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 text-lg">
                            </div>

                            <div>
                                <label for="isi_pengaduan" class="block text-sm font-medium text-gray-700">Isi
                                    Pengaduan</label>
                                <textarea name="isi_pengaduan" id="isi_pengaduan" rows="4" required
                                    class="mt-2 block w-full rounded-md-10 border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-lg"></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="tanggal_pengaduan"
                                        class="block text-sm font-medium text-gray-700">Tanggal Pengaduan</label>
                                    <input type="date" name="tanggal_pengaduan" id="tanggal_pengaduan" required
                                        class="h-8 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>
                                <div>
                                    <label for="lokasi_kejadian"
                                        class="block text-sm font-medium text-gray-700">Lokasi
                                        Kejadian</label>
                                    <input type="text" name="lokasi_kejadian" id="lokasi_kejadian" required
                                        class="h-8 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </div>
                            </div>

                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                                <input type="text" name="alamat" id="alamat" required
                                    class="mt-2 h-8 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="file_pendukung" class="block text-sm font-medium text-gray-700">Unggah
                                    File
                                    Pendukung</label>
                                <input type="file" name="file_pendukung" id="file_pendukung" required
                                    accept=".pdf,.jpg,.jpeg,.png,.docx,.xlsx"
                                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                    class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-lg font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                                    Kirim Pengaduan
                                </button>
                            </div>
                        </form>
                    </div>
                </section>

                <!-- Konsultasi Section -->
                <section x-show="mode === 'konsultasi'"
                    class="max-w-4xl mx-auto bg-white shadow-2xl rounded-lg overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white">
                        <h2 class="text-3xl font-bold text-center">Konsultasi dengan Kami</h2>
                        <p class="text-center mt-2 text-blue-100">Hubungi kami melalui salah satu cara di bawah ini
                        </p>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            @php
                                $contacts = App\Models\ContactOption::all();
                            @endphp
                            @foreach ($contacts as $contact)
                                @switch($contact->type)
                                    @case('whatsapp')
                                        <a href="https://wa.me/{{ $contact->value }}"
                                            class="flex items-center justify-center p-4 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300 shadow-md">
                                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                            WhatsApp
                                        </a>
                                    @break

                                    @case('email')
                                        <a href="mailto:{{ $contact->value }}"
                                            class="flex items-center justify-center p-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 shadow-md">
                                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            Email
                                        </a>
                                    @break

                                    @case('phone')
                                        <a href="tel:{{ $contact->value }}"
                                            class="flex items-center justify-center p-4 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition duration-300 shadow-md">
                                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                                </path>
                                            </svg>
                                            Telepon
                                        </a>
                                    @break

                                    @case('instagram')
                                        <a href="https://www.instagram.com/{{ $contact->value }}"
                                            class="flex items-center justify-center p-4 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition duration-300 shadow-md">
                                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                                            </svg>
                                            Instagram
                                        </a>
                                    @break
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                </section>

                <!-- History Pengaduan Section -->
                <section x-show="mode === 'History_Pengaduan'"
                    class="max-w-4xl mx-auto bg-white shadow-2xl rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white">
                        <h2 class="text-3xl font-bold text-center">Riwayat Pengaduan</h2>
                        <p class="text-center mt-2 text-blue-100">Lihat status dan detail pengaduan Anda</p>
                    </div>

                    <div class="p-8">
                        @php
                            $pengaduans = App\Models\Pengaduan::where('user_id', auth()->user()->id)->paginate(5);
                        @endphp

                        <!-- Search Bar -->

                        <div class="mb-4">
                            <form method="GET" action="{{ route('pengaduan.home') }}"
                                class="flex items-center space-x-2">
                                <input type="text" name="search" placeholder="Cari..."
                                    value="{{ request('search') }}"
                                    class="border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-1/2 lg:w-1/3">
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Cari</button>
                            </form>
                        </div>


                        <!-- Pengaduan List -->
                        <div class="space-y-4">
                            @forelse ($pengaduans as $pengaduan)
                                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                    <div class="flex justify-between items-start">
                                        <h3 class="font-semibold text-lg text-blue-600">
                                            {{ $pengaduan->judul_pengaduan }}</h3>
                                        <span
                                            class="text-xs font-semibold px-3 py-1 rounded-full
                                                @if ($pengaduan->status == 'belum_proses') bg-red-100 text-red-700
                                                @elseif ($pengaduan->status == 'proses') bg-yellow-100 text-yellow-700
                                                @elseif ($pengaduan->status == 'selesai') bg-green-100 text-green-700
                                                @elseif ($pengaduan->status == 'dilanjutkan') bg-blue-100 text-blue-700
                                                @elseif ($pengaduan->status == 'dibatalkan') bg-gray-100 text-gray-700 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $pengaduan->status)) }}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 text-sm mt-2">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $pengaduan->lokasi_kejadian }}
                                    </p>
                                    <p class="text-gray-500 text-sm mt-1">
                                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        {{ $pengaduan->tanggal_pengaduan }}
                                    </p>
                                </div>

                                <!-- Buttons for "Batalkan" and "Lihat Detail" -->
                                <div class="mt-4 flex space-x-4">
                                    <!-- Button Lihat Detail -->
                                    <a href="{{ route('pengaduan.show', $pengaduan->id) }}"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                                        Lihat Detail
                                    </a>

                                    <!-- Button Batalkan -->
                                    @if ($pengaduan->status != 'dibatalkan')
                                        <form method="POST"
                                            action="{{ route('pengaduan.batalkan', $pengaduan->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                                Batalkan
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @empty
                                <p class="text-center text-gray-500 py-4">Belum ada pengaduan.</p>
                            @endforelse

                            <!-- Pagination Links -->
                            <div class="mt-6">
                                {{ $pengaduans->links() }}
                            </div>
                        </div>



                    </div>
                </section>
            </div>
        </form>
    </div>




    <!-- Help Button and Popup -->
    <div class="fixed bottom-4 right-4" x-data="{ open: false }">
        <!-- Help Button -->
        <button @click="open = !open"
            class="bg-green-500 text-white font-semibold py-4 px-7 rounded-full shadow-md hover:bg-green-600 transition duration-300 ease-in-out transform hover:scale-105">
            Help
        </button>

        <!-- Pop-up modal with contact options -->
        <div x-show="open" @click.away="open = false"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
            class="fixed bottom-16 right-4 space-y-4 p-4 bg-white rounded-lg shadow-lg w-56">

            @foreach ($contacts as $contact)
                @if ($contact->type == 'whatsapp')
                    <a href="https://wa.me/{{ $contact->value }}"
                        class="flex items-center space-x-3 bg-green-100 text-green-600 p-3 rounded-lg hover:bg-green-200 transition duration-200">
                        <!-- WhatsApp Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                            fill="currentColor" stroke="none">
                            <path fill-rule="evenodd"
                                d="M12 1.5C6.216 1.5 1.5 6.216 1.5 12c0 2.071.574 4.016 1.565 5.652l-.822 3.077 3.146-.822A10.488 10.488 0 0012 22.5c5.784 0 10.5-4.716 10.5-10.5S17.784 1.5 12 1.5zm-2.36 7.2h.002c.29-.002.589.004.867.004.268 0 .487.04.694.38.174.293.667.936.746 1.012.077.074.146.136.177.174.09.109.184.227.285.285.136.078.355.225.418.322.14.215.67 1.047.756 1.247.088.199.07.332-.037.505-.109.174-.51.96-1.032 1.006-.143.015-.46-.005-.668-.074-.209-.067-.43-.211-.522-.261-.233-.133-.33-.296-.483-.423-.115-.095-.267-.21-.33-.285-.051-.061-.113-.12-.157-.18-.109-.131-.195-.156-.248-.21-.075-.078-.154-.17-.285-.28-.174-.148-.354-.307-.433-.417-.079-.111-.092-.135-.115-.185-.024-.05-.08-.104-.156-.222-.141-.209-.194-.31-.248-.417-.059-.118-.186-.335-.372-.456-.183-.117-.387-.199-.57-.25-.19-.053-.41-.08-.604-.08h-.055c-.245-.002-.466-.003-.653-.003-.091 0-.186-.003-.265-.003-.03 0-.093-.003-.197-.003z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">WhatsApp</span>
                    </a>
                @elseif ($contact->type == 'email')
                    <a href="mailto:{{ $contact->value }}"
                        class="flex items-center space-x-3 bg-blue-100 text-blue-600 p-3 rounded-lg hover:bg-blue-200 transition duration-200">
                        <!-- Email Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16.5 3.75h-9A3.75 3.75 0 003.75 7.5v9a3.75 3.75 0 003.75 3.75h9a3.75 3.75 0 003.75-3.75v-9a3.75 3.75 0 00-3.75-3.75zM4.5 7.241L12 12.37l7.5-5.128M12 13.5l-7.5 5.25" />
                        </svg>
                        <span class="font-medium">Email</span>
                    </a>
                @elseif ($contact->type == 'phone')
                    <a href="tel:{{ $contact->value }}"
                        class="flex items-center space-x-3 bg-yellow-100 text-yellow-600 p-3 rounded-lg hover:bg-yellow-200 transition duration-200">
                        <!-- Phone Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.25 6.75l4.125 2.062A2.25 2.25 0 018.25 10.73l1.125 2.25a2.25 2.25 0 002.25 1.125 2.25 2.25 0 002.25-2.25v-3.75l1.125-.562a2.25 2.25 0 002.25 1.125l4.125 2.062" />
                        </svg>
                        <span class="font-medium">Telepon</span>
                    </a>
                @elseif ($contact->type == 'instagram')
                    <a href="https://www.instagram.com/{{ $contact->value }}"
                        class="flex items-center space-x-3 bg-purple-100 text-purple-600 p-3 rounded-lg hover:bg-purple-200 transition duration-200">
                        <!-- Meeting Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.75 7.5H17.25A2.25 2.25 0 0119.5 9.75V12H16.5M7.5 16.5h9m0 0l-3-3m3 3l-3 3" />
                        </svg>
                        <span class="font-medium">Instagram</span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>

    <div id="kontak">
        <x-user.footer>

        </x-user.footer>
    </div>

</body>

</html>
