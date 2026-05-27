@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="w-full flex flex-col space-y-8">
        <div class="flex flex-row gap-8">
            <div class="flex flex-col flex-1 justify-center items-center bg-slate-100 rounded-4xl py-6 px-10 gap-4">
                <div class="flex flex-col items-center gap-2">
                    <i data-lucide="users"></i>
                    <h1 class="text-lg font-normal">Pengguna Aktif</h1>
                </div>

                <h1 class="text-4xl font-bold text-primary-8">{{ $activeUsers }}</h1>
            </div>

            <div class="flex flex-col flex-1 justify-center items-center bg-slate-100 rounded-4xl py-6 px-10 gap-4">
                <div class="flex flex-col items-center gap-2">
                    <i data-lucide="folder"></i>
                    <h1 class="text-lg font-normal">Proyek Aktif</h1>
                </div>

                <h1 class="text-4xl font-bold text-primary-8">{{ $activeProjects }}</h1>
            </div>

            <div class="flex flex-col flex-1 justify-center items-center bg-slate-100 rounded-4xl py-6 px-10 gap-4">
                <div class="flex flex-col items-center gap-2">
                    <i data-lucide="users"></i>
                    <h1 class="text-lg font-normal">Total Pengguna</h1>
                </div>

                <h1 class="text-4xl font-bold text-primary-8">{{ $totalUsers }}</h1>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-slate-200">
            <h2 class="text-xl font-bold mb-4">Grafik Proyek per Bulan</h2>
            <div class="w-full h-80 relative">
                <canvas id="projectChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('projectChart').getContext('2d');
            const projectChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Jumlah Proyek Dibuat',
                        data: {!! json_encode($chartDataValues) !!},
                        backgroundColor: '#4361EE', // Primary color
                        borderRadius: 4,
                        barThickness: 30
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
@endsection
