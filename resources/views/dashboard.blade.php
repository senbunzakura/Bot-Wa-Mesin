@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
    <div class="right_col" role="main">
        <div class="col-lg-12">
            <div class="top_tiles">
                <h1 class="text-center mb-4">Selamat Datang Di <strong>SP2M</strong></h1>
                <div class="row justify-content-center">
                    <!-- Statistik Kartu -->
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #007bff; border-radius: 10px;">
                            <div>
                                <h5>Total Mesin</h5>
                                <h3 class="text-white">{{ $totalMesin }}</h3>
                            </div>
                            <i class="fa fa-industry fa-2x"></i>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #28a745; border-radius: 10px;">
                            <div>
                                <h5>Total Perawatan</h5>
                                <h3 class="text-white">{{ $totalPerawatan }}</h3>
                            </div>
                            <i class="fa fa-tools fa-2x"></i>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #ffc107; border-radius: 10px;">
                            <div>
                                <h5>Total Perbaikan</h5>
                                <h3 class="text-white">{{ $totalPerbaikan }}</h3>
                            </div>
                            <i class="fa fa-screwdriver-wrench fa-2x"></i>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 mb-4">
                        <div class="tile-stats d-flex justify-content-between align-items-center text-white p-3"
                            style="background-color: #dc3545; border-radius: 10px;">
                            <div>
                                <h5>Total Laporan</h5>
                                <h3 class="text-white">{{ $totalLaporan }}</h3>
                            </div>
                            <i class="fa fa-clipboard-list fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik Monitoring --}}
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Status Laporan Kerusakan per Bulan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                     <canvas id="laporanChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Status Perbaikan per Bulan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                       <canvas id="perbaikanChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Status Perawatan per Bulan</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                     <canvas id="perawatanChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        const laporanData =
        @json($laporanByBulan); // format: ['pending' => [...12], 'proses' => [...], 'selesai' => [...]]
        const perbaikanData = @json($perbaikanByBulan);
        const perawatanData = @json($perawatanByBulan);

        function renderGroupedBar(canvasId, dataByStatus) {
            const ctx = document.getElementById(canvasId).getContext("2d");

            const statusWarna = {
                'pending': '#f39c12',
                'proses': '#007bff',
                'selesai': '#28a745'
            };

            const datasets = Object.entries(dataByStatus).map(([status, data], idx) => ({
                label: status.charAt(0).toUpperCase() + status.slice(1),
                data: data,
                backgroundColor: statusWarna[status] || '#999',
                barThickness: 12
            }));

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: bulan,
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: (context) => `${context.dataset.label}: ${context.parsed.y}`
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: true
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                precision: 0
                            }
                        }
                    }
                }
            });
        }

        renderGroupedBar('laporanChart', laporanData);
        renderGroupedBar('perbaikanChart', perbaikanData);
        renderGroupedBar('perawatanChart', perawatanData);
    </script>
@endsection
