<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tindak Lanjut Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <x-admin.navadmin> </x-admin.navadmin>
    <!-- Main Content -->
    <x-admin.headadmin> </x-admin.headadmin>

    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">Tindak Lanjut Pengaduan</h2>

                <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Add your form fields for tindak lanjut here -->
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status"
                            class="mt-1 block w-full bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                            <option value="dilanjutkan">Dilanjutkan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                        <textarea id="catatan" name="catatan" rows="4"
                            class="mt-1 block w-full bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"></textarea>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
