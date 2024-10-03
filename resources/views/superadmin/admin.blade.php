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
    </style>
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <x-superadmin.navsuper> </x-superadmin.navsuper>
    <!-- Main Content -->
    <x-superadmin.headsuper> </x-superadmin.headsuper>

    <!-- Search Bar -->
    <main class="flex-1 p-6 bg-gray-100">
        <div class="mb-4">
            <form method="GET" action="{{ route('superadmin.admin') }}" class="flex items-center space-x-2">
                <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}"
                    class="border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-1/2 lg:w-1/3">
                <button type="submit"y
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Cari</button>
            </form>
        </div>

        <!-- Tabel Data User -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Telephone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tanggal Akun
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($admins as $admin)
                        <tr class="table-row transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $admin->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $admin->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $admin->telephone ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $admin->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $admin->role }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Aktif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="#" class="text-blue-500 hover:underline">Edit</a>
                                <a href="#" class="ml-4 text-red-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data admin yang
                                ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
            </thead>
    </main>
    </div>
    </div>

</body>

</html>
