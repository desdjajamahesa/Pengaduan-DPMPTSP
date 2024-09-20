<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superadmin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function enableEditMode() {
            document.getElementById('contact-view').classList.add('hidden');
            document.getElementById('contact-edit').classList.remove('hidden');
        }
    </script>
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
    <x-superadmin.navsuper></x-superadmin.navsuper>
    <!-- Main Content -->
    <x-superadmin.headsuper></x-superadmin.headsuper>


    <div class="container mx-auto p-8 max-w-lg">
        <h1 class="text-2xl font-bold text-center mb-8 text-gray-800">Superadmin - Manage Contact Options</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif
        <!-- View Mode (static display) -->
        <div id="contact-view" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">WhatsApp</label>
                <p class="text-gray-900">{{ optional($contacts->where('type', 'whatsapp')->first())->value }}</p>
            </div>
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">Email</label>
                <p class="text-gray-900">{{ optional($contacts->where('type', 'email')->first())->value }}</p>
            </div>
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">Phone</label>
                <p class="text-gray-900">{{ optional($contacts->where('type', 'phone')->first())->value }}</p>
            </div>
            <div class="mb-5">
                <label class="block text-gray-700 font-medium mb-2">Meeting Link</label>
                <p class="text-gray-900">{{ optional($contacts->where('type', 'meeting')->first())->value }}</p>
            </div>

            <!-- Button to enable editing -->
            <button type="button" onclick="enableEditMode()"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition-colors">
                Edit Contacts
            </button>
        </div>

        <!-- Edit Mode (form to edit) -->
        <div id="contact-edit" class="hidden bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('contacts.update') }}" method="POST" class="space-y-6">
                @csrf
                <div class="mb-5">
                    <label for="whatsapp" class="block text-gray-700 font-medium mb-2">WhatsApp</label>
                    <input type="text" name="contacts[0][value]"
                        value="{{ optional($contacts->where('type', 'whatsapp')->first())->value }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                    <input type="hidden" name="contacts[0][type]" value="whatsapp">
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="contacts[1][value]"
                        value="{{ optional($contacts->where('type', 'email')->first())->value }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                    <input type="hidden" name="contacts[1][type]" value="email">
                </div>

                <div class="mb-5">
                    <label for="phone" class="block text-gray-700 font-medium mb-2">Phone</label>
                    <input type="text" name="contacts[2][value]"
                        value="{{ optional($contacts->where('type', 'phone')->first())->value }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                    <input type="hidden" name="contacts[2][type]" value="phone">
                </div>

                <div class="mb-5">
                    <label for="meeting" class="block text-gray-700 font-medium mb-2">Meeting Link</label>
                    <input type="text" name="contacts[3][value]"
                        value="{{ optional($contacts->where('type', 'meeting')->first())->value }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                    <input type="hidden" name="contacts[3][type]" value="meeting">
                </div>

                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md transition-colors">
                    Update Contacts
                </button>
            </form>
        </div>
    </div>
</body>

</html>
