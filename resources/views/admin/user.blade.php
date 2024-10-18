<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users S!Padu - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <x-admin.navadmin> </x-admin.navadmin>
    <!-- Main Content -->
    <x-admin.headadmin> </x-admin.headadmin>

    <!-- Search Bar -->
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">User Management</h2>

                    <!-- Search Bar -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('admin.user') }}" class="flex items-center space-x-4">
                            <div class="relative flex-grow">
                                <input type="text" name="search" placeholder="Search users..."
                                    value="{{ request('search') }}"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                                Search
                            </button>
                        </form>
                    </div>

                    <!-- User Table -->
                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table
                            class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th
                                        class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        ID</th>
                                    <th
                                        class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Name</th>
                                    <th
                                        class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Email</th>
                                    <th
                                        class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Telephone</th>
                                    <th
                                        class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Created At</th>
                                    <th
                                        class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Role</th>
                                    <th
                                        class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Status</th>
                                    <th
                                        class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-100 transition-colors duration-200">
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                            {{ $loop->iteration }}</td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $user->name }}
                                        </td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $user->email }}
                                        </td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                            {{ $user->telephone }}</td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                            {{ $user->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $user->role }}
                                            </span>
                                        </td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Active
                                            </span>
                                        </td>
                                        <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 transition duration-150 ease-in-out">
                                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out"
                                                        onclick="return confirm('Are you sure you want to delete this user?')">
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
                                        <td colspan="8"
                                            class="border-dashed border-t border-gray-200 px-6 py-4 text-center text-gray-500">
                                            No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
