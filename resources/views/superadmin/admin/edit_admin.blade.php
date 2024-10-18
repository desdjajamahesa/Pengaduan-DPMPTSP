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

    <div class="min-h-screen bg-gray-100">
    

        <main class="flex-1 p-6 bg-gray-100">
            <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-blue-500 text-white">
                    <h2 class="text-2xl font-bold">Edit Admin</h2>
                </div>
                <form action="{{ route('superadmin.admin.update', $admin->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="telephone" class="block text-sm font-medium text-gray-700">Telephone</label>
                        <input type="tel" name="telephone" id="telephone"
                            value="{{ old('telephone', $admin->telephone) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('superadmin.admin') }}"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Save Changes</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>
