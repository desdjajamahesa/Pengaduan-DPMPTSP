<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

<body>
    <x-user.navbar></x-user.navbar>

    <body class="bg-gray-50">
        <div class="container mx-auto px-4 py-16">
            <!-- Page Title -->
            <section id="stat">
                <div class="text-center py-8">
                    <h2 class="text-3xl font-bold text-gray-800">Statistik Pengaduan DPMPTSP</h2>
                </div>
                <!-- Cards Section -->
                <div class="flex justify-center space-x-8 mb-16">
                    <!-- Pelapor Card -->
                    <div class="bg-white rounded-lg shadow-md p-8 text-center w-1/3">
                        <h4 class="text-xl font-semibold text-gray-700">Pelapor</h4>
                    </div>
                    <!-- Status Pengaduan Card -->
                    <div class="bg-white rounded-lg shadow-md p-8 text-center w-1/3">
                        <h4 class="text-xl font-semibold text-gray-700">Status Pengaduan</h4>
                    </div>
                </div>
            </section>

            <section id="sop" style="padding-top: 200px">
                <!-- Image Section -->
                <div class="flex justify-center mb-16">
                    @php
                        $sop = App\Models\Sop::first();
                    @endphp
                    @if ($sop && $sop->image_url)
                        <img src="{{ asset('storage/' . $sop->image_url) }}" alt="Alur Pengaduan"
                            class="max-w-full h-auto rounded-lg shadow-lg">
                    @else
                        <p class="text-gray-500">Tidak ada SOP yang diunggah.</p>
                    @endif
                </div>

                <!-- Button Section -->
                <div class="text-center mb-16">
                    @if ($sop && $sop->image_url)
                        <a href="{{ asset('storage/' . $sop->image_url) }}" download
                            class="inline-block bg-blue-500 text-white font-semibold py-3 px-6 rounded-md hover:bg-blue-600">Unduh</a>
                    @else
                        <p class="text-gray-500">Tidak ada SOP yang dapat diunduh.</p>
                    @endif
                </div>
            </section>



            <section id="form">

                <section id="form">
                    <form action="{{ route('pengaduan.store') }}" method="POST" onsubmit="confirmSubmission(event)">
                        @csrf
                        <!-- Complaint Form -->
                        <div class="text-center py-8">
                            <h2 class="text-3xl font-bold text-gray-800">Forms Pengaduan DPMPTSP</h2>
                        </div>
                        <div class="mt-16 max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-10">
                            <h3 class="text-2xl font-semibold text-gray-800 mb-8">Pengaduan</h3>
                            <div class="mb-6">
                                <label for="judul_pengaduan" class="block text-gray-700 font-medium mb-3">Judul
                                    Pengaduan</label>
                                <input type="text" name="judul_pengaduan"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
                            </div>

                            <div class="mb-6">
                                <label for="tanggal_pengaduan" class="block text-gray-700 font-medium mb-3">Tanggal
                                    Pengaduan</label>
                                <input type="date" name="tanggal_pengaduan"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
                            </div>

                            <div class="mb-6">
                                <label for="lokasi_kejadian" class="block text-gray-700 font-medium mb-3">Lokasi
                                    Kejadian</label>
                                <input type="text" name="lokasi_kejadian"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
                            </div>

                            <div class="mb-6">
                                <label for="alamat" class="block text-gray-700 font-medium mb-3">Alamat</label>
                                <input type="text" name="alamat"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required>
                            </div>

                            <div class="mb-8">
                                <label for="isi_pengaduan" class="block text-gray-700 font-medium mb-3">Isi
                                    Pengaduan</label>
                                <textarea name="isi_pengaduan" rows="5"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    required></textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-500 text-white font-semibold py-3 px-6 rounded-md hover:bg-blue-600">Adukan</button>
                        </div>
                    </form>
                </section>

                <!-- Success Modal -->
                <div x-data="{ open: @if (session('success')) true @else false @endif }" x-show="open" @click.away="open = false"
                    class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm mx-auto">
                        <h3 class="text-lg font-semibold text-gray-800">Pemberitahuan</h3>
                        <p class="mt-2 text-gray-600">Pengaduan berhasil dikirim!</p>
                        <div class="mt-4 text-right">
                            <button @click="open = false"
                                class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600">Tutup</button>
                        </div>
                    </div>
                </div>
        </div>

        </section>
        </div>
        <!-- Button Help and Popup -->
        <div class="fixed bottom-4 right-4" x-data="{ open: false }">
            <!-- Help Button -->
            <button @click="open = !open"
                class="bg-green-500 text-white font-semibold py-4 px-7 rounded-full hover:bg-green-600">
                Help
            </button>

            <!-- Pop-up modal with contact options -->
            <div x-show="open" class="fixed bottom-16 right-4 flex flex-col space-y-4">
                <div class="flex items-center space-x-1 bg-white p-4 rounded-full shadow-lg">
                    <span class="font-medium text-gray-700"></span>
                    <a href="https://wa.me/6281293984743" class="text-blue-500">
                        <img src="https://img.icons8.com/color/48/000000/whatsapp.png" class="h-8 w-8" alt="WhatsApp">
                    </a>
                </div>
                <div class="flex items-center space-x-2 bg-white p-4 rounded-full shadow-lg">
                    <span class="font-medium text-gray-700"></span>
                    <a href="mailto:smaasmerul@gmail.com" class="text-blue-500">
                        <img src="https://img.icons8.com/color/48/000000/email.png" class="h-8 w-8" alt="Email">
                    </a>
                </div>
                <div class="flex items-center space-x-2 bg-white p-4 rounded-full shadow-lg">
                    <span class="font-medium text-gray-700"></span>
                    <a href="tel:+6281293984743" class="text-blue-500">
                        <img src="https://img.icons8.com/color/48/000000/phone.png" class="h-8 w-8" alt="Phone">
                    </a>
                </div>
                <div class="flex items-center space-x-2 bg-white p-4 rounded-full shadow-lg">
                    <span class="font-medium text-gray-700"></span>
                    <a href="#" class="text-blue-500">
                        <img src="https://img.icons8.com/color/48/000000/meeting.png" class="h-8 w-8"
                            alt="Face-to-face Meeting">
                    </a>
                </div>
            </div>
        </div>
        <section id="kontak">
            <x-user.footer></x-user.footer>
        </section>
    </body>

</html>
