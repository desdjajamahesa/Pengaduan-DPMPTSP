<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            margin-right: 20px;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Sidebar -->
    <x-admin.navadmin class="fixed top-0 left-0 right-0 z-50"></x-admin.navadmin>
    <!-- Main Content -->
    <x-admin.headadmin class="fixed top-0 left-0 right-0 z-50"></x-admin.headadmin>
    <div class="flex-1 flex flex-col overflow-hidden">

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <h3 class="text-gray-700 text-3xl font-medium">Dashboard</h3>

                <!-- Statistik Pengaduan -->
                <div class="flex flex-wrap -mx-6">
                    @php
                        $cards = [
                            [
                                'title' => 'Total Pengaduan',
                                'value' => $totalPengaduan,
                                'icon' => 'M12 2a10 10 0 1110 10A10 10 0 0112 2z',
                                'color' => 'blue',
                            ],
                            [
                                'title' => 'Pengaduan Hari Ini',
                                'value' => $pengaduanToday,
                                'icon' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z',
                                'color' => 'green',
                            ],
                            [
                                'title' => 'Jumlah Pengguna',
                                'value' => $endUserCount,
                                'icon' => 'M12 4C6.48 4 2 8.48 2 12s4.48 8 10 8 10-4.48 10-8S17.52 4 12 4z',
                                'color' => 'yellow',
                            ],
                            [
                                'title' => 'Pengaduan Diproses',
                                'value' => $pengaduanDiproses,
                                'icon' => 'M12 2L2 12l10 10L22 12L12 2z',
                                'color' => 'indigo',
                            ],
                            [
                                'title' => 'Pengaduan Tertunda',
                                'value' => $pengaduanTertunda,
                                'icon' => 'M10 3h4v14h-4z',
                                'color' => 'red',
                            ],
                            [
                                'title' => 'Pengaduan Selesai',
                                'value' => $pengaduanSelesai,
                                'icon' => 'M19 13l-7 7-7-7',
                                'color' => 'teal',
                            ],
                            [
                                'title' => 'Pengaduan Ditolak',
                                'value' => $pengaduanDitolak,
                                'icon' => 'M5 15l7 7 7-7',
                                'color' => 'purple',
                            ],
                            [
                                'title' => 'Pengaduan Batal',
                                'value' => $pengaduanDibatalkan,
                                'icon' => 'M5 5l14 14',
                                'color' => 'orange',
                            ],
                        ];
                    @endphp
                    @foreach ($cards as $card)
                        <div class="w-full sm:w-1/2 md:w-1/3 xl:w-1/4 px-6 py-4">
                            <div class="card bg-white rounded-lg shadow-xl p-6 flex items-center space-x-4">
                                <div class="card-icon bg-{{ $card['color'] }}-100 text-{{ $card['color'] }}-800 pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $card['icon'] }}" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800">{{ $card['title'] }}</h2>
                                    <p class="mt-2 text-3xl font-bold text-{{ $card['color'] }}-600">
                                        {{ $card['value'] }}
                                        @if (in_array($card['title'], ['Pengaduan Diproses', 'Pengaduan Tertunda', 'Pengaduan Selesai']))
                                            <span class="text-sm font-normal text-gray-500">
                                                ({{ $totalPengaduan > 0 ? round(($card['value'] / $totalPengaduan) * 100, 2) : 0 }}%)
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Grafik -->
                <div class="mt-8">
                    <h3 class="text-gray-700 text-3xl font-medium">Statistik Pengaduan</h3>
                    <div class="flex flex-shrink-0 gap-2 mt-3">
                        <div class="w-full lg:w-1/2 bg-white rounded-lg shadow-xl p-4">
                            <canvas id="pengaduanChart" class="w-full"></canvas>
                        </div>
                        <div id="pieChartContainer" class="w-full lg:w-1/2 bg-white rounded-lg shadow-xl p-4">
                            <div id="pieChart" style="width: 100%; height: 400px;"></div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Pelapor Terkini -->
                <div class="mt-8">
                    <h3 class="text-gray-700 text-3xl font-medium">Pelapor Terkini</h3>
                    <div class="mt-8 overflow-x-auto">
                        <table class="min-w-full bg-white rounded-lg">
                            <thead class="bg-gradient-to-r from-indigo-300 to-cyan-400 text-white">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">Name
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">Email
                                    </th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left uppercase">Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentPengaduans as $pengaduan)
                                    <tr class="bg-white hover:bg-indigo-50 transition-all duration-200">
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm font-medium text-gray-900">{{ $pengaduan->user->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm text-gray-500">{{ $pengaduan->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <span
                                                class="inline-block px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-semibold">
                                                {{ $pengaduan->tanggal_pengaduan->format('d M Y H:i') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pie Chart
            Highcharts.chart('pieChart', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Komposisi Status Pengaduan'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                },
                series: [{
                    name: 'Status',
                    colorByPoint: true,
                    data: [{
                            name: 'Diproses',
                            y: {{ $pengaduanDiproses }},
                            sliced: true,
                            selected: true
                        },
                        {
                            name: 'Tertunda',
                            y: {{ $pengaduanTertunda }}
                        },
                        {
                            name: 'Selesai',
                            y: {{ $pengaduanSelesai }}
                        },
                        {
                            name: 'Ditolak',
                            y: {{ $pengaduanDitolak }}
                        },
                        {
                            name: 'Dibatalkan',
                            y: {{ $pengaduanDibatalkan }}
                        }
                    ]
                }]
            });

            // Bar Chart
            const ctx = document.getElementById('pengaduanChart').getContext('2d');

            const barColors = [
                'rgba(75, 192, 192, 0.8)', // Diproses
                'rgba(255, 99, 132, 0.8)', // Tertunda
                'rgba(54, 162, 235, 0.8)', // Selesai
                'rgba(255, 206, 86, 0.8)', // Ditolak
                'rgba(153, 102, 255, 0.8)' // Dibatalkan
            ];

            const barChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Diproses', 'Tertunda', 'Selesai', 'Ditolak', 'Dibatalkan'],
                    datasets: [{
                        label: 'Jumlah Pengaduan',
                        data: [
                            {{ $pengaduanDiproses }},
                            {{ $pengaduanTertunda }},
                            {{ $pengaduanSelesai }},
                            {{ $pengaduanDitolak }},
                            {{ $pengaduanDibatalkan }}
                        ],
                        backgroundColor: barColors,
                        borderColor: barColors.map(color => color.replace('0.8', '1.0')),
                        borderWidth: 1,
                        borderRadius: 10, // Membuat sudut bar melengkung
                        hoverBackgroundColor: barColors.map(color => color.replace('0.8', '1.0'))
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            grid: {
                                display: false // Hilangkan garis grid di sumbu X
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false // Hilangkan garis grid di sumbu Y
                            },
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Sembunyikan legenda untuk tampilan lebih minimalis
                        },
                        tooltip: {
                            enabled: true,
                            callbacks: {
                                label: function(tooltipItem) {
                                    const value = tooltipItem.raw;
                                    return `${tooltipItem.label}: ${value} pengaduan`;
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Statistik Pengaduan',
                            color: '#4A5568', // Warna teks
                            font: {
                                size: 18,
                                weight: 'bold'
                            }
                        }
                    },
                    onClick: (event, elements) => {
                        if (elements.length > 0) {
                            const index = elements[0].index;
                            const label = barChart.data.labels[index];
                            const value = barChart.data.datasets[0].data[index];
                            alert(`Anda mengklik "${label}" dengan nilai ${value}`);
                        }
                    }
                }
            });
        });
    </script>

</body>

</html>
