<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SOP</title>
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
    <x-admin.navadmin></x-admin.navadmin>
    <!-- Main Content -->
    <x-admin.headadmin></x-admin.headadmin>
    <div class="container mx-auto px-4 py-6">
        <!-- Pencarian -->


        <!-- Form untuk Menambah Gambar SOP -->
        <div class="mb-4">
            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.sop.store') }}" enctype="multipart/form-data"
                class="flex items-center space-x-2">
                @csrf
                <input type="file" name="image" accept="image/*" required
                    class="border border-gray-300 rounded-lg px-4 py-2">
                <button type="submit"
                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300">Tambah
                    SOP</button>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Gambar SOP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($sops->isEmpty())
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">Tidak ada SOP yang ditemukan.
                            </td>
                        </tr>
                    @else
                        @foreach ($sops as $sop)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if ($sop->image_url)
                                        <img src="{{ asset('storage/' . $sop->image_url) }}" alt="SOP Image"
                                            class="w-32 h-32 object-cover rounded-lg shadow-md">
                                    @else
                                        <p class="text-gray-500">Tidak ada gambar</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex space-x-4">
                                    <!-- Edit Button -->
                                    <button
                                        onclick="openModal('{{ $sop->id }}', '{{ asset('storage/' . $sop->image_url) }}')"
                                        class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 transition duration-300 ease-in-out shadow-md transform hover:scale-105">
                                        Edit
                                    </button>
                                    <!-- Hapus Button -->
                                    <form method="POST" action="{{ route('admin.sop.destroy', $sop->id) }}"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 transition duration-300 ease-in-out shadow-md transform hover:scale-105"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus SOP ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>


        <div class="mt-4">
            {{ $sops->links() }}
        </div>
    </div>

    <!-- Modal Edit SOP -->
    <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 w-1/2">
            <h2 class="text-xl font-bold mb-4">Edit SOP</h2>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="sop_id" id="sop_id">
                <input type="file" name="image" accept="image/*" required
                    class="border border-gray-300 rounded-lg px-4 py-2 mb-4">
                <button type="submit"
                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300">Update
                    SOP</button>
                <button type="button"
                    class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 transition duration-300 ease-in-out shadow-md transform hover:scale-105"
                    onclick="closeModal()">Batal</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(sopId, imageUrl) {
            document.getElementById('sop_id').value = sopId;
            document.getElementById('editForm').action = '/sop/' + sopId; // Atur action untuk form
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>

</body>

</html>
