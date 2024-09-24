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
        <section id="sop" class="py-16 mb-28">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-semibold text-gray-800">Alur Pengaduan</h3>
            </div>

            <!-- Image Section -->
            <div class="flex justify-center mb-8">
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
            <div class="text-center">
                @if ($sop && $sop->image_url)
                    <a href="{{ asset('storage/' . $sop->image_url) }}" download
                        class="inline-block bg-blue-500 text-white font-semibold py-3 px-6 rounded-md hover:bg-blue-600 transition duration-200">Unduh
                        SOP</a>
                @else
                    <p class="text-gray-500">Tidak ada SOP yang dapat diunduh.</p>
                @endif
            </div>
        </section>

        <!-- Mode Tabs: Pengaduan & Konsultasi -->

        <form action="{{ route('pengaduan.store') }}" method="POST" onsubmit="confirmSubmission(event)"
            class="space-y-6 mt-20 mb-10">
            @csrf
            <div x-data="{ mode: 'pengaduan' }">
                <div class="flex justify-center mb-8">
                    <button @click="mode = 'pengaduan'"
                        :class="mode === 'pengaduan' ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700'"
                        class="px-4 py-2 rounded-l-lg focus:outline-none hover:bg-red-600">Pengaduan</button>
                    <button @click="mode = 'konsultasi'"
                        :class="mode === 'konsultasi' ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700'"
                        class="px-4 py-2 rounded-r-lg focus:outline-none hover:bg-red-600">Konsultasi</button>
                </div>

                <!-- Pengaduan Form Section -->
                <section x-show="mode === 'pengaduan'" class="bg-white shadow-lg rounded-lg p-8 max-w-4xl mx-auto">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-bold text-gray-800">Sampaikan Laporan Anda</h2>
                    </div>

                    <form action="{{ route('pengaduan.store') }}" method="POST" class="space-y-6"
                        onsubmit="return confirmSubmission(event)">
                        <!-- Judul Pengaduan -->
                        <div>
                            <label for="judul_pengaduan" class="block text-gray-700 font-medium mb-5 mt-2">Judul
                                Pengaduan</label>
                            <input type="text" name="judul_pengaduan" id="judul_pengaduan"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                placeholder="Masukkan judul pengaduan Anda" required>
                        </div>

                        <!-- Isi Pengaduan -->
                        <div>
                            <label for="isi_pengaduan" class="block text-gray-700 font-medium mb-2 mt-2">Isi
                                Pengaduan</label>
                            <textarea name="isi_pengaduan" id="isi_pengaduan" rows="5"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                placeholder="Masukkan detail pengaduan Anda" required></textarea>
                        </div>

                        <!-- Tanggal dan Lokasi Kejadian -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <div>
                                <label for="tanggal_pengaduan" class="block text-gray-700 font-medium mb-2">Tanggal
                                    Pengaduan</label>
                                <input type="date" name="tanggal_pengaduan" id="tanggal_pengaduan"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    required>
                            </div>

                            <div>
                                <label for="lokasi_kejadian" class="block text-gray-700 font-medium mb-2 mt-2">Lokasi
                                    Kejadian</label>
                                <input type="text" name="lokasi_kejadian" id="lokasi_kejadian"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    placeholder="Masukkan lokasi kejadian" required>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-gray-700 font-medium mb-2">Alamat</label>
                            <input type="text" name="alamat" id="alamat"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                placeholder="Masukkan alamat Anda" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center ">
                            <button type="submit "
                                class="bg-blue-500 text-white font-semibold py-5 px-5 rounded-lg hover:bg-blue-600 pt-4 mt-4">
                                Kirim Pengaduan
                            </button>
                        </div>
                    </form>
                </section>
        </form>
        <!-- Konsultasi Section -->
        <section x-show="mode === 'konsultasi'" class="bg-white shadow-lg rounded-lg p-8 max-w-4xl mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Konsultasi dengan Kami</h2>
                <p class="text-gray-600">Hubungi kami melalui salah satu cara di bawah ini:</p>
            </div>

            <!-- Dynamic Contact Section -->
            @php
                $contacts = App\Models\ContactOption::all();
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:grid-cols-4">
                @foreach ($contacts as $contact)
                    @if ($contact->type == 'whatsapp')
                        <div class="flex justify-center">
                            <a href="{{ $contact->value }}"
                                class="flex items-center space-x-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg hover:bg-green-600 transition duration-300 ease-in-out transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="h-6 w-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.25 12C2.25 6.615 6.615 2.25 12 2.25s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75A9.738 9.738 0 015.53 19.97L3 21l1.03-2.53A9.738 9.738 0 012.25 12z" />
                                </svg>
                                <span class="font-semibold">WhatsApp</span>
                            </a>
                        </div>
                    @elseif ($contact->type == 'email')
                        <div class="flex justify-center">
                            <a href="mailto:{{ $contact->value }}"
                                class="flex items-center space-x-4 bg-blue-500 text-white px-6 py-4 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="h-6 w-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16.5 3.75h-9A3.75 3.75 0 003.75 7.5v9a3.75 3.75 0 003.75 3.75h9a3.75 3.75 0 003.75-3.75v-9a3.75 3.75 0 00-3.75-3.75zM4.5 7.241L12 12.37l7.5-5.128M12 13.5l-7.5 5.25" />
                                </svg>
                                <span class="font-semibold">Email</span>
                            </a>
                        </div>
                    @elseif ($contact->type == 'phone')
                        <div class="flex justify-center">
                            <a href="tel:{{ $contact->value }}"
                                class="flex items-center space-x-4 bg-yellow-500 text-white px-6 py-4 rounded-lg shadow-lg hover:bg-yellow-600 transition duration-300 ease-in-out transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="h-6 w-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.25 6.75l4.125 2.062A2.25 2.25 0 018.25 10.73l1.125 2.25a2.25 2.25 0 002.25 1.125 2.25 2.25 0 002.25-2.25v-3.75l1.125-.562a2.25 2.25 0 002.25 1.125l4.125 2.062" />
                                </svg>
                                <span class="font-semibold">Telepon</span>
                            </a>
                        </div>
                    @elseif ($contact->type == 'meeting')
                        <div class="flex justify-center">
                            <a href="{{ $contact->value }}"
                                class="flex items-center space-x-4 bg-purple-500 text-white px-6 py-4 rounded-lg shadow-lg hover:bg-purple-600 transition duration-300 ease-in-out transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" class="h-6 w-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.75 7.5H17.25A2.25 2.25 0 0119.5 9.75V12H16.5M7.5 16.5h9m0 0l-3-3m3 3l-3 3" />
                                </svg>
                                <span class="font-semibold">Meeting Online</span>
                            </a>
                        </div>
                    @endif
                @endforeach


            </div>
        </section>
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
                    <a href="{{ $contact->value }}"
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
                @elseif ($contact->type == 'meeting')
                    <a href="{{ $contact->value }}"
                        class="flex items-center space-x-3 bg-purple-100 text-purple-600 p-3 rounded-lg hover:bg-purple-200 transition duration-200">
                        <!-- Meeting Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.75 7.5H17.25A2.25 2.25 0 0119.5 9.75V12H16.5M7.5 16.5h9m0 0l-3-3m3 3l-3 3" />
                        </svg>
                        <span class="font-medium">Meeting Online</span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>

    </div>
    <footer class="bg-gray-800 text-white py-10">
        <footer class="bg-black text-center text-white py-6">
            <div class="container mx-auto">
                <h2 class="text-2xl font-bold mb-4">DPMPTSP</h2>
                <ul class="flex justify-center space-x-6 mb-6">
                    <li><a href="#stat" class="hover:text-green-500">Statistik</a></li>
                    <li><a href="#sop" class="hover:text-green-500">SOP</a></li>
                    <li><a href="#form" class="hover:text-green-500">Pengaduan</a></li>
                    <li><a href="#kontak" class="hover:text-green-500">Kontak</a></li>
                </ul>
                <div class="flex justify-center space-x-6 mb-6">
                    <a href="#" class="text-green-500 hover:text-green-400"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-green-500 hover:text-green-400"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-green-500 hover:text-green-400"><i
                            class="fab fa-instagram"></i></a>
                </div>
                <p class="text-sm text-gray-500">
                    Copyright &copy;2021 All rights reserved | This template is made with
                    <span class="text-green-500">&hearts;</span> by <a href="https://colorlib.com"
                        class="text-green-500 hover:text-green-400">DPMPTSP</a>
                </p>
            </div>
        </footer>

    </footer>


</body>

</html>
