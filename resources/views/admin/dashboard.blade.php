<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            margin-right: 20px;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Sidebar -->
    <x-admin.navadmin class="fixed top-0 left-0 right-0 z-50"> </x-admin.navadmin>
    <!-- Main Content -->
    <x-admin.headadmin class="fixed top-0 left-0 right-0 z-50"> </x-admin.headadmin>
    <div class="flex-1 flex flex-col overflow-hidden">

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">
                <h3 class="text-gray-700 text-3xl font-medium">Dashboard</h3>
                <div class="mt-8">
                    <div class="flex flex-wrap -mx-6">
                        @php
                            $cards = [
                                [
                                    'title' => 'Total Pengaduan',
                                    'value' => $totalPengaduan,
                                    'icon' => 'M3 4a3 3 0 013-3h12a3 3 0 013 3v16a3 3 0 01-3 3H6a3 3 0 01-3-3V4z',
                                    'color' => 'blue',
                                ],
                                [
                                    'title' => 'Pengaduan Hari Ini',
                                    'value' => $pengaduanToday,
                                    'icon' => 'M5 3l14 14m0 0l-4 4m4-4H9l-4 4m0 0V3',
                                    'color' => 'green',
                                ],
                                [
                                    'title' => 'Jumlah Pengguna',
                                    'value' => $endUserCount,
                                    'icon' => 'M20 12H4',
                                    'color' => 'yellow',
                                ],
                                [
                                    'title' => 'Pengaduan Diproses',
                                    'value' => $pengaduanDiproses,
                                    'icon' => 'M3 12h18m-9 9V3',
                                    'color' => 'indigo',
                                ],
                                [
                                    'title' => 'Pengaduan Tertunda',
                                    'value' => $pengaduanTertunda,
                                    'icon' => 'M17 12H7m0 0l5 5m-5-5l5-5',
                                    'color' => 'red',
                                ],
                                [
                                    'title' => 'Pengaduan Selesai',
                                    'value' => $pengaduanSelesai,
                                    'icon' => 'M5 13l4 4L19 7',
                                    'color' => 'teal',
                                ],
                            ];
                        @endphp
                        @foreach ($cards as $card)
                            <div class="w-full md:w-1/2 lg:w-1/3 px-6 py-3">
                                <div
                                    class="card bg-white rounded-lg shadow-xl p-6 flex items-center space-x-4 hover:shadow-2xl transition-all duration-300">
                                    <div
                                        class="card-icon bg-{{ $card['color'] }}-100 text-{{ $card['color'] }}-800 pulse">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ $card['icon'] }}" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-semibold text-gray-800">{{ $card['title'] }}</h2>
                                        <p class="mt-2 text-3xl font-bold text-{{ $card['color'] }}-600">
                                            {{ $card['value'] }}
                                            @if (in_array($card['title'], ['Pengaduan Diproses', 'Pengaduan Tertunda', 'Pengaduan Selesai']))
                                                <span class="text-sm font-normal text-gray-500">
                                                    ({{ $totalPengaduan > 0 ? round(($card['value'] / $totalPengaduan) * 100, 2) : 0 }}%)
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-8">
                    <h3 class="text-gray-700 text-3xl font-medium">Pelapor Terkini</h3>
                    <div class="flex flex-col mt-8">
                        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                            <div
                                class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow-lg sm:rounded-lg hover:shadow-2xl transition-shadow duration-300">
                                <table class="min-w-full bg-white rounded-lg">
                                    <thead class="bg-gradient-to-r from-indigo-300 to-cyan-400 text-white">

                                        <tr>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase border-b border-gray-200">
                                                Name
                                            </th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase border-b border-gray-200">
                                                Email
                                            </th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase border-b border-gray-200">
                                                Date
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentPengaduans as $pengaduan)
                                            <tr class="bg-white hover:bg-indigo-50 transition-all duration-200">
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $pengaduan->user?->name ?? 'User tidak ditemukan' }}

                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm text-gray-500">
                                                        {{ $pengaduan->user?->email ?? 'Email tidak tersedia' }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <span
                                                        class="inline-block px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-semibold">
                                                        {{ $pengaduan->tanggal_pengaduan->format('d M Y H:i') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </main>
    </div>

</body>

</html>
