{{-- resources/views/admin/profile.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Sidebar -->
    <x-superadmin.navsuper></x-superadmin.navsuper>

    <!-- Main Content -->
    <x-superadmin.headsuper></x-superadmin.headsuper>


    <div class="container mx-auto py-8 px-4 sm:px-8 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row items-center justify-between">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-3xl font-bold text-gray-900">Super Admin Dashboard</h1>
                    <p class="mt-1 text-sm text-gray-600">Manage your profile</p>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Admin Profile Section -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Profile Image Section -->
                    <div class="flex flex-col items-center md:w-1/3 mt-12">
                        <div class="relative group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-16 h-16 text-gray-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14c4 0 6-4 6-6s-2-6-6-6-6 4-6 6 2 6 6 6zm0 0c-2 0-3.5.5-4.5 1.5C6.5 16.5 6 18 6 18h12s-.5-1.5-1.5-2.5C15.5 14.5 14 14 12 14z" />
                            </svg>
                        </div>
                        <h2 class="mt-4 text-xl font-semibold text-gray-900">{{ $superadmin->name }}</h2>
                        <span
                            class="inline-flex items-center px-3 py-1 mt-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($superadmin->role) }}
                        </span>
                    </div>


                    <!-- Profile Form Section -->
                    <div class="md:w-2/3">
                        <form action="{{ route('superadmin.profile.update', $superadmin->id) }}" method="POST"
                            class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $superadmin->name) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $superadmin->email) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('email') border-red-500 @enderror">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                    <input type="text" name="telephone"
                                        value="{{ old('telephone', $superadmin->telephone) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('telephone') border-red-500 @enderror">
                                    @error('telephone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Passwor Baru</label>
                                    <input type="password" name="password" placeholder="Leave blank to keep current"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('password') border-red-500 @enderror">
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi
                                        Password</label>
                                    <input type="password" name="password_confirmation"
                                        placeholder="Confirm new password"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                </div>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit"
                                    class="inline-flex items-center px-6 py-2.5 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
