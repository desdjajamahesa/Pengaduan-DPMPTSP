<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
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

        .table-row:hover {
            background-color: rgba(59, 130, 246, 0.1);
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <x-admin.navadmin></x-admin.navadmin>
    <!-- Main Content -->
    <x-admin.headadmin></x-admin.headadmin>
    <div class="container mx-auto px-4 py-6">
        <!-- Pencarian -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.pengaduan') }}" class="flex items-center space-x-2">
                <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}"
                    class="border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-1/2 lg:w-1/3">
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Cari</button>
            </form>
        </div>

        <!-- Tabel Pengaduan -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Judul Pengaduan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Isi Pengaduan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tanggal Pengaduan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Lokasi Pengaduan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($pengaduans as $pengaduan)
                        <tr class="table-row transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pengaduan->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pengaduan->user->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pengaduan->judul_pengaduan }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pengaduan->isi_pengaduan }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pengaduan->tanggal_pengaduan }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pengaduan->lokasi_kejadian }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($pengaduan->status == 'dibatalkan')
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 text-red-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 1a9 9 0 100 18 9 9 0 000-18zM10 0a10 10 0 100 20A10 10 0 0010 0zm1 13h-2V7h2v6zm0 2h-2v-2h2v2z" />
                                        </svg>
                                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full">Di Batalkan</span>
                                    </span>
                                @elseif ($pengaduan->status == 'belum_proses')
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 text-yellow-500 mr-1" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 1a9 9 0 100 18 9 9 0 000-18zM10 0a10 10 0 100 20A10 10 0 0010 0zm1 13h-2V7h2v6zm0 2h-2v-2h2v2z" />
                                        </svg>
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full">Belum
                                            Diproses</span>
                                    </span>
                                @elseif ($pengaduan->status == 'proses')
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 text-yellow-500 mr-1" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 1a9 9 0 100 18 9 9 0 000-18zM10 0a10 10 0 100 20A10 10 0 0010 0zm1 13h-2V7h2v6zm0 2h-2v-2h2v2z" />
                                        </svg>
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full">Proses</span>
                                    </span>
                                @elseif ($pengaduan->status == 'selesai')
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-1" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 1a9 9 0 100 18 9 9 0 000-18zM10 0a10 10 0 100 20A10 10 0 0010 0zm1 13h-2V7h2v6zm0 2h-2v-2h2v2z" />
                                        </svg>
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full">Selesai</span>
                                    </span>
                                @elseif ($pengaduan->status == 'dilanjutkan')
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 text-blue-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 1a9 9 0 100 18 9 9 0 000-18zM10 0a10 10 0 100 20A10 10 0 0010 0zm1 13h-2V7h2v6zm0 2h-2v-2h2v2z" />
                                        </svg>
                                        <span
                                            class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full">Dilanjutkan</span>
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="{{ route('admin.pengaduan.tindak-lanjut', $pengaduan->id) }}"
                                    class="text-blue-500 hover:text-blue-700">Tindak Lanjut</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">Tidak ada pengaduan yang
                                ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $pengaduans->links() }}
        </div>
    </div>

</body>

</html>
