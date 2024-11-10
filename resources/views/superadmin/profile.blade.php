{{-- resources/views/superadmin/profile.blade.php --}}
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
                    <h1 class="text-3xl font-bold text-gray-900">SuperAdmin Dashboard</h1>
                    <p class="mt-1 text-sm text-gray-600">Manage your profile and view other superadmins</p>
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

        <!-- SuperAdmin Cards Grid -->
        <div class="grid gap-8">
            @foreach ($superadmins as $superadmin)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row gap-6">
                            <!-- Profile Image Section -->
                            <div class="flex flex-col items-center md:w-1/3">
                                <div class="relative group">
                                    <img src="{{ $superadmin->profile_image_url ?? 'https://via.placeholder.com/150' }}"
                                        alt="Profile Image"
                                        class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                                    <div
                                        class="absolute inset-0 rounded-full bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                        <span class="text-white text-sm">Change Photo</span>
                                    </div>
                                </div>
                                <h2 class="mt-4 text-xl font-semibold text-gray-900">{{ $superadmin->name }}</h2>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mt-2">
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
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                        <input type="text" name="name"
                                            value="{{ old('name', $superadmin->name) }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('name') border-red-500 @enderror">
                                        @error('name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                            <input type="email" name="email"
                                                value="{{ old('email', $superadmin->email) }}"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('email') border-red-500 @enderror">
                                            @error('email')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone No</label>
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
                                            <label class="block text-sm font-medium text-gray-700 mb-1">New
                                                Password</label>
                                            <input type="password" name="password"
                                                placeholder="Leave blank to keep current"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('password') border-red-500 @enderror">
                                            @error('password')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm
                                                Password</label>
                                            <input type="password" name="password_confirmation"
                                                placeholder="Confirm new password"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                        </div>
                                    </div>

                                    <div class="flex justify-end pt-4">
                                        <button type="submit"
                                            class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                            </svg>
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- SuperAdmin Stats -->
                    <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 rounded-b-xl">
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Created</p>
                                <p class="mt-1 text-xl font-semibold text-gray-900">
                                    {{ $superadmin->created_at->format('M d, Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-2">
                                    Active
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Optional: Add some JavaScript for interactivity -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const successMessage = document.querySelector('[role="alert"]');
            if (successMessage) {
                successMessage.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    </script>
</body>

</html>
