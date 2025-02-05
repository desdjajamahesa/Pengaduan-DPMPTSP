<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-image: url('bg-textured.png');

            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <script defer>
        function confirmSubmission(event) {
            event.preventDefault(); // Mencegah form dikirim langsung

            const form = event.target;

            // Mengumpulkan data form
            const formData = new FormData(form);
            const judulPengaduan = formData.get('judul_pengaduan') || "Tidak diisi";
            const tanggalPengaduan = formData.get('tanggal_pengaduan') || "Tidak diisi";
            const lokasiKejadian = formData.get('lokasi_kejadian') || "Tidak diisi";
            const alamat = formData.get('alamat') || "Tidak diisi";
            const isiPengaduan = formData.get('isi_pengaduan') || "Tidak diisi";

            // Menampilkan pesan konfirmasi
            const confirmationMessage =
                `Apakah Anda yakin ingin mengirimkan pengaduan ini?\n\n` +
                `Judul Pengaduan: ${judulPengaduan}\n` +
                `Tanggal Pengaduan: ${tanggalPengaduan}\n` +
                `Lokasi Kejadian: ${lokasiKejadian}\n` +
                `Alamat: ${alamat}\n` +
                `Isi Pengaduan: ${isiPengaduan}`;

            if (confirm(confirmationMessage)) {
                form.submit(); // Mengirim form jika dikonfirmasi
            }
        }
    </script>
    <?php $pengadu = Auth::user(); ?>
    <title>Selamat Datang | {{ $pengadu->name }}</title>
</head>

<body class="" style="background-color: rgb(255, 255, 255);">

    <x-user.navbar></x-user.navbar>
    <div class="" style="">

        <!-- Hero Section Fullscreen dengan Transparansi -->
        <section id="hero" class="relative bg-gray-900 text-white min-h-screen flex items-center justify-center"
            style="background-image: url('logo-full.jpg'); background-size: contain; background-position: center;">
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black opacity-60"></div>

            <!-- Hero Content -->
            <div class="container mx-auto relative z-10 text-center px-4">
                <!-- Card Transparan -->
                <div class="bg-white bg-opacity-20 backdrop-blur-md rounded-lg p-10 inline-block">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                        Selamat Datang di Layanan Pengaduan DPMPTSP
                    </h1>
                    <p class="text-lg md:text-xl lg:text-2xl mb-8">
                        Kami siap membantu Anda dalam menyampaikan pengaduan dengan cepat dan mudah.
                    </p>

                    <!-- Call-to-Action Buttons -->
                    <div class="flex flex-col md:flex-row justify-center gap-4">
                        <a href="#stat"
                            class="bg-blue-500 bg-opacity-80 hover:bg-opacity-100 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                            Lihat Statistik
                        </a>
                        <a href="#form"
                            class="bg-gray-700 bg-opacity-80 hover:bg-opacity-100 text-white font-semibold py-3 px-8 rounded-lg transition duration-300">
                            Buat Pengaduan
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Page Title -->
        <section id="stat" class="text-center py-28 mb-32 relative overflow-hidden">
            <!-- Overlay -->
            <div class="absolute inset-0"></div> <!-- Add overlay here -->


            <!-- Content -->
            <div class="relative z-10 container mx-auto px-4">
                @php
                    $totalPengaduan = $totalPengaduan ?? App\Models\Pengaduan::count(); // Set default jika belum ada
                    $pengaduanProses = $pengaduanProses ?? App\Models\Pengaduan::where('status', 'selesai')->count();
                    $persentaseProses =
                        $persentaseProses ?? ($totalPengaduan > 0 ? ($pengaduanProses / $totalPengaduan) * 100 : 0);
                @endphp
                <h2 class="text-4xl font-bold text-black mb-4">Statistik Pengaduan DPMPTSP</h2>
                <p class="text-gray-600 mb-8">Lihat statistik pelapor dan status pengaduan yang diterima.</p>

                <!-- Cards Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <!-- Pelapor Card -->
                    <div
                        class="bg-white rounded-xl shadow-lg p-8 text-center transform hover:scale-105 hover:shadow-2xl transition duration-300 ease-in-out">
                        <h4 class="text-2xl font-semibold text-gray-800">Pelapor</h4>
                        <p class="text-gray-500 mt-4">Jumlah pengaduan yang diajukan oleh masyarakat.</p>
                        <p class="text-xl font-bold text-gray-800 mt-4">{{ $totalPengaduan }}</p>
                    </div>

                    <!-- Status Pengaduan Card -->
                    <div
                        class="bg-white rounded-xl shadow-lg p-8 text-center transform hover:scale-105 hover:shadow-2xl transition duration-300 ease-in-out">
                        <h4 class="text-2xl font-semibold text-gray-800">Status Pengaduan</h4>
                        <p class="text-gray-500 mt-4">Proses pengaduan yang sudah diproses.</p>
                        <p class="text-xl font-bold text-gray-800 mt-4">
                            {{ number_format($persentaseProses, 2) }}%</p>
                    </div>
                </div>
            </div>
        </section>



        <section id="sop" class="py-28">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Alur Pengaduan</h2>
                        <div class="w-24 h-1 bg-blue-500 mx-auto"></div>
                    </div>

                    @php
                        $sops = App\Models\Sop::all();
                    @endphp

                    @if ($sops->isNotEmpty())
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                            <div class="p-8">
                                <!-- Konten SOP, hanya satu yang akan ditampilkan pada satu waktu -->
                                @foreach ($sops as $index => $sop)
                                    <div id="step-{{ $index }}"
                                        class="sop-step {{ $index == 0 ? '' : 'hidden' }}">
                                        <div class="relative w-full" style="height: 70vh;">
                                            <img src="{{ asset('storage/' . $sop->image_url) }}"
                                                alt="Alur Pengaduan {{ $index + 1 }}"
                                                class="absolute inset-0 w-full h-full object-contain rounded-lg cursor-pointer"
                                                onclick="openFullscreen(this)">
                                        </div>
                                        <div class="mt-6 flex justify-center space-x-4">
                                            <a href="{{ asset('storage/' . $sop->image_url) }}" target="_blank"
                                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                                Lihat Gambar Penuh
                                            </a>
                                            <a href="{{ asset('storage/' . $sop->image_url) }}" download
                                                class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                                Unduh SOP
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Tombol navigasi -->
                                <div class="mt-6 flex justify-between">
                                    <button onclick="prevStep()"
                                        class="px-6 py-3 bg-gray-600 text-white rounded-full hover:bg-gray-700"
                                        id="prevBtn" disabled>Sebelumnya</button>
                                    <button onclick="nextStep()"
                                        class="px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700"
                                        id="nextBtn">Selanjutnya</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                            <div class="p-8 text-center py-16">
                                <p class="text-xl text-gray-600 mb-2">Tidak ada SOP yang diunggah.</p>
                                <p class="text-gray-500">Silakan hubungi administrator untuk informasi lebih lanjut.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <script>
            let currentStep = 0;
            const totalSteps = {{ count($sops) }};

            function showStep(step) {
                // Sembunyikan semua langkah
                document.querySelectorAll('.sop-step').forEach((element, index) => {
                    element.classList.toggle('hidden', index !== step);
                });

                // Perbarui tombol navigasi
                document.getElementById('prevBtn').disabled = step === 0;
                document.getElementById('nextBtn').disabled = step === totalSteps - 1;
            }

            function nextStep() {
                if (currentStep < totalSteps - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            }

            function prevStep() {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            }

            // Tampilkan langkah pertama
            showStep(currentStep);
        </script>



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
    <div class="container mx-auto px-4 pb-[300px] mt-32 py-28" id="form">

        @csrf
        <div x-data="{ mode: 'pengaduan' }">
            <div class="flex justify-center mb-8">
                <button @click="mode = 'pengaduan'" type="button"
                    :class="mode === 'pengaduan' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
                    class="px-4 py-2 rounded-l-lg focus:outline-none hover:bg-blue-600">Pengaduan</button>
                <button @click="mode = 'History_Pengaduan'" type="button"
                    :class="mode === 'History_Pengaduan' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
                    class="px-4 py-2  focus:outline-none hover:bg-blue-600">History
                    Pengaduan</button>
                <button @click="mode = 'konsultasi'" type="button"
                    :class="mode === 'konsultasi' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
                    class="px-4 py-2 rounded-r-lg focus:outline-none hover:bg-blue-600">Konsultasi</button>
            </div>

            <!-- Pengaduan Form Section -->
            <section x-show="mode === 'pengaduan'"
                class="max-w-4xl mx-auto bg-white shadow-2xl rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white">
                    <h2 class="text-3xl font-bold text-center">Sampaikan Laporan Anda</h2>
                    <h4 class="text-center">(Format OMBUDSMAN Tahun 2024)</h4>
                    <p class="text-center mt-2 text-blue-100">Kami siap mendengar dan menindaklanjuti laporan
                        Anda
                    </p>
                </div>

                <div class="p-8">
                    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data"
                        onsubmit="return confirmSubmission(event)" class="space-y-6">
                        @csrf
                        <div>
                            <label for="kategori_bidang" class="block text-sm font-medium text-gray-700">Kategori
                                Bidang</label>
                            <select name="kategori_bidang" id="kategori_bidang" required
                                class="mt-2 block w-full h-8 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-lg">
                                <option value="" disabled selected>Pilih Kategori Bidang</option>
                                <option value="Penanaman Modal">Penanaman Modal</option>
                                <option value="Pembangunan">Pembangunan</option>
                                <option value="Perizinan">Perizinan</option>

                            </select>
                            @if ($errors->has('kategori_bidang'))
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $errors->first('kategori_bidang') }}
                                </p>
                            @endif
                        </div>
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
                                <label for="tanggal_pengaduan" class="block text-sm font-medium text-gray-700">Tanggal
                                    Pengaduan</label>
                                <input type="date" name="tanggal_pengaduan" id="tanggal_pengaduan" required
                                    class="h-8 mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="lokasi_kejadian" class="block text-sm font-medium text-gray-700">Lokasi
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
                            <label for="file_pendukung" class="block text-sm font-medium text-gray-700">
                                Unggah File Pendukung
                            </label>
                            <input type="file" name="file_pendukung" id="file_pendukung"
                                accept=".pdf,.jpg,.jpeg,.png,.docx,.xlsx"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="mt-2 text-xs text-gray-500">
                                Anda dapat mengunggah file dengan format: PDF, JPG, JPEG, PNG, DOCX, atau XLSX.
                            </p>
                            @if ($errors->has('file_pendukung'))
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $errors->first('file_pendukung') }}
                                </p>
                            @endif
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
                    <div class="grid grid-cols-1 sm:grid-cols-2  lg:grid-cols-3 gap-4">
                        @php
                            $contacts = App\Models\ContactOption::all();
                        @endphp
                        @foreach ($contacts as $contact)
                            @switch($contact->type)
                                @case('whatsapp')
                                    <a href="https://wa.me/{{ $contact->value }}"
                                        class="flex items-center justify-center p-4 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300 shadow-md">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
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
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Email
                                    </a>
                                @break

                                @case('instagram')
                                    <a href="https://www.instagram.com/{{ $contact->value }}"
                                        class="flex items-center justify-center p-4 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition duration-300 shadow-md">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
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
                                    {{ $pengaduan->created_at }}
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
                                @if (
                                    $pengaduan->status != 'dibatalkan' &&
                                        $pengaduan->status != 'selesai' &&
                                        $pengaduan->status != 'dilanjutkan' &&
                                        $pengaduan->status != 'proses')
                                    <form method="POST" action="{{ route('pengaduan.batalkan', $pengaduan->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition"
                                            onclick="return confirm('Apakah Anda yakin ingin membatalkan pengaduan ini?')">
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
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
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
                @elseif ($contact->type == 'instagram')
                    <a href="https://www.instagram.com/{{ $contact->value }}"
                        class="flex items-center space-x-3 bg-purple-100 text-purple-600 p-3 rounded-lg hover:bg-purple-200 transition duration-200">
                        <!-- Meeting Icon -->
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
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
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>
