<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superadmin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.2) 0%, rgba(59, 130, 246, 0.1) 100%);
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <x-superadmin.navsuper></x-superadmin.navsuper>

    <!-- Main Content -->
    <x-superadmin.headsuper></x-superadmin.headsuper>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg">
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Pengaduan Management</h2>

                    <!-- Search Bar -->
                    <div class="mb-8">
                        <form method="GET" action="{{ route('superadmin.pengaduan') }}"
                            class="flex items-center space-x-4">
                            <div class="relative flex-grow">
                                <input type="text" name="search" placeholder="Cari pengaduan..."
                                    value="{{ request('search') }}"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 transition">
                                Cari
                            </button>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <table class="min-w-full bg-white divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul
                                        Pengaduan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Isi
                                        Pengaduan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal
                                        Pengaduan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi
                                        Pengaduan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pengaduans as $pengaduan)
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $pengaduan->user->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $pengaduan->user->email }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $pengaduan->judul_pengaduan }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $pengaduan->isi_pengaduan }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $pengaduan->tanggal_pengaduan }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $pengaduan->lokasi_kejadian }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            @if ($pengaduan->status == 'proses')
                                                <span
                                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Proses</span>
                                            @elseif($pengaduan->status == 'dilanjutkan')
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Lanjut</span>
                                            @elseif($pengaduan->status == 'selesai')
                                                <span
                                                    class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Selesai</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium">
                                            <a href="{{ route('superadmin.tindak-lanjut', $pengaduan->id) }}"
                                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 transition transform hover:-translate-y-1 hover:shadow-lg">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
                                                    </path>
                                                </svg>
                                                Tindak Lanjut
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 text-center text-gray-500">Tidak ada
                                            pengaduan yang ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $pengaduans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
