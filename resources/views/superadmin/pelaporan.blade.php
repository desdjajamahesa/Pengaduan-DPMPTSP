    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Pelaporan S!Padu</title>
        <script src="https://cdn.tailwindcss.com"></script>
        @vite('resources/css/app.css')
    </head>

    <body>
        <!-- Sidebar -->
        <x-superadmin.navsuper></x-superadmin.navsuper>

        <!-- Main Content -->

        <x-superadmin.headsuper></x-superadmin.headsuper>

        <div class="py-12 bg-gray-100">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Rekapitulasi Pengaduan</h2>
                        <h4 class="">(Format OMBUDSMAN Tahun 2024)</h4>
                        <div class="flex justify-end mb-4">
                            <a href="{{ route('export.pengaduan') }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">
                                Download Pelaporan
                            </a>
                        </div>
                        <!-- Search Bar -->
                        <div class="mb-8">
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
                                                Jenis</th>
                                            <th
                                                class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                                Platform</th>
                                            <th
                                                class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                                Email</th>
                                            <th
                                                class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                                Username</th>
                                            <th
                                                class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                                NIB/Nomor Resi/Nomor Permohonan/Jenis Permohonan</th>
                                            <th
                                                class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                                Waktu Pengaduan</th>
                                            <th
                                                class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                                Isi Pengaduan</th>
                                            <th
                                                class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                                Waktu Jawab</th>

                                            <th
                                                class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                                Petugas Yang Melayani</th>
                                            <th
                                                class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                                Status</th>
                                            <th
                                                class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                                Kesesuaian SOP</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($pengaduans as $pengaduan)
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $pengaduan->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $pengaduan->jenis }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $pengaduan->platform ?? 'N/A' }}</td>
                                                <!-- Platform bisa ditambahkan sesuai kebutuhan -->
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $pengaduan->user->email }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $pengaduan->user->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $pengaduan->id ?? 'N/A' }}</td>
                                                <!-- NIB atau jenis data lainnya -->
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $pengaduan->tanggal_pengaduan->format('d-m-Y H:i') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $pengaduan->isi_pengaduan }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $pengaduan->tindaklanjut ?? 'Belum Ditindaklanjuti' }}</td>

                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $pengaduan->admin ?? 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $pengaduan->status }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $pengaduan->kesesuaian_sop ?? 'Belum Diperiksa' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>

    </body>

    </html>
