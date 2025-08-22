@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <!-- Jalan Sudah di SFO -->
            <div class="col-md-6 mb-3">
                <div class="stat-card p-4 h-100">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <div class="text-center">
                            <h5 class="text-uppercase text-muted fw-bold mb-2">JALAN SUDAH DI SFO</h5>
                            <h2 class="fw-bold text-primary mb-0" style="font-size: 32px;">10.0 KM</h2>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <select class="form-select rounded-3 form-select-sm w-auto border-2 border-primary fw-semibold text-muted" style="box-shadow:none;">
                                    <option selected>2025</option>
                                    <option>2024</option>
                                    <option>2023</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jalan Belum di SFO -->
            <div class="col-md-6 mb-3">
                <div class="stat-card p-4 h-100">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <div class="text-center">
                            <h5 class="text-uppercase text-muted fw-bold mb-2">JALAN BELUM DI SFO</h5>
                            <h2 class="fw-bold text-center text-primary mb-0" style="font-size: 32px;">10.0 KM</h2>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <select class="form-select rounded-3 border-primary border-2 form-select-sm w-auto fw-semibold text-muted"
                                    style="box-shadow:none;">
                                    <option selected>2025</option>
                                    <option>2024</option>
                                    <option>2023</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik SFO -->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-container p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0">GRAFIK SFO</h5>
                        <select class="form-select border-primary border-2 rounded-3 form-select-sm w-auto fw-semibold text-muted" style="box-shadow:none;">
                            <option selected>2025</option>
                            <option>2024</option>
                            <option>2023</option>
                        </select>
                    </div>
                    <div style="height: 280px;">
                        <canvas id="sfoChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .stat-card,
        .chart-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }
        
        .stat-card {
            min-height: 130px;
            display: flex;
            flex-direction: column;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('sfoChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGS'],
                        datasets: [{
                            label: 'KM',
                            data: [6, 5, 8, 12, 16, 9, 12, 4],
                            borderColor: '#007bff',
                            backgroundColor: '#007bff',
                            borderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            tension: 0.3,
                            fill: false
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#4a5568',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                padding: 5,
                                displayColors: false,
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed.y + " KM";
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 5
                                }
                            },
                            x: {
                                ticks: {
                                    font: {
                                        weight: '600'
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection