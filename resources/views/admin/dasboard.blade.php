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

    <!-- Dashboard Content -->
    <main class="flex-1 p-6 bg-gray-100">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Stats Card 1 -->
            <div class="card bg-white p-6 shadow-md rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800">Total Users</h2>
                <p class="mt-2 text-gray-600 text-2xl">1,234</p>
            </div>

            <!-- Stats Card 2 -->
            <div class="card bg-white p-6 shadow-md rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800">Total Sales</h2>
                <p class="mt-2 text-gray-600 text-2xl">$56,789</p>
            </div>

            <!-- Stats Card 3 -->
            <div class="card bg-white p-6 shadow-md rounded-lg">
                <h2 class="text-xl font-semibold text-gray-800">New Orders</h2>
                <p class="mt-2 text-gray-600 text-2xl">45</p>
            </div>

        </div>

        <!-- Recent Activity Table -->
        <div class="mt-8 bg-white p-6 shadow-md rounded-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Activity</h2>
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="table-header">
                    <tr>
                        <th class="py-3 px-4 border-b text-left text-gray-600">User</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600">Action</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600">Date</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <tr class="hover:bg-gray-50 transition ease-in-out duration-150">
                        <td class="py-2 px-4 border-b">John Doe</td>
                        <td class="py-2 px-4 border-b">Created a new order</td>
                        <td class="py-2 px-4 border-b">2024-09-01</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition ease-in-out duration-150">
                        <td class="py-2 px-4 border-b">Jane Smith</td>
                        <td class="py-2 px-4 border-b">Updated profile</td>
                        <td class="py-2 px-4 border-b">2024-09-02</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>

    </main>
    </div>
    </div>

</body>

</html>
