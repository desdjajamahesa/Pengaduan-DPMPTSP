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
  <x-admin.navadmin></x-admin.navadmin>
  <!-- Main Content -->
  <x-admin.headadmin></x-admin.headadmin>

  <div class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Rekapitulasi Pengaduan</h2>

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
                                      Tautan Percakapan</th>
                                  <th
                                      class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                                      Tangkapan Layar</th>
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
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"></td>
                                </tr>
                            {{-- @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada pengaduan yang ditemukan.
                                    </td>
                                </tr> --}}
                        </tbody>
                    </table>
                </div>
                </div>
</div>
</body>
</html>