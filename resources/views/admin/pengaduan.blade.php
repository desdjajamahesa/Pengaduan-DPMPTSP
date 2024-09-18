<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    <x-admin.navadmin> </x-admin.navadmin>
    <!-- Main Content -->
    <x-admin.headadmin> </x-admin.headadmin>

    <div class="container mx-auto px-4 py-6">
        <!-- Pencarian -->
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.pengaduan') }}">
                <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}"
                    class="border border-gray-300 rounded-lg px-4 py-2">
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg">Cari</button>
            </form>
        </div>

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
                    @foreach ($pengaduans as $pengaduan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pengaduan->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pengaduan->user->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pengaduan->judul_pengaduan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pengaduan->isi_pengaduan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pengaduan->tanggal_pengaduan }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pengaduan->lokasi_kejadian }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($pengaduan->status == 'proses')
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Proses</span>
                                @elseif($pengaduan->status == 'lanjut')
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Lanjut</span>
                                @elseif($pengaduan->status == 'selesai')
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Selesai</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="{{ route('admin.pengaduan.tindak-lanjut', $pengaduan->id) }}"
                                    class="text-blue-500 hover:text-blue-700">Tindak Lanjut</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $pengaduans->links() }} <!-- Tailwind pagination -->
        </div>
    </div>

</body>

</html>
