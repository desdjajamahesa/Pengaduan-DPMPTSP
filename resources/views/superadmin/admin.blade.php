<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
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
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Telephone</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($admins as $admin)
                        <tr class="hover:bg-gray-100 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $admin->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $admin->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $admin->telephone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('superadmin.admin.edit', $admin->id) }}"
                                        class="text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out">
                                        <svg class="h-5 w-5" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('superadmin.admin.destroy', $admin->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            <svg class="h-5 w-5" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada admin yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

            <!-- Tombol Tambah Admin -->
        </div>
        <a href="{{ route('superadmin.admin.create') }}"
            class="mt-4 inline-block px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
            Tambah Admin
        </a>
    </main>



</body>

</html>
