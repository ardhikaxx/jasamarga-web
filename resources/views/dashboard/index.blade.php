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
                            <h2 class="fw-bold text-success mb-0" style="font-size: 32px;">{{ $jalanSudahSfo }} KM</h2>
                            <div class="mt-2">
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i> {{ number_format($progressPercentage, 1) }}%
                                    Tercapai
                                </span>
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
                            <h2 class="fw-bold {{ $jalanBelumSfo == 0 ? 'text-success' : 'text-warning' }} mb-0"
                                style="font-size: 32px;">
                                {{ $jalanBelumSfo }} KM
                            </h2>
                            <div class="mt-2">
                                @if ($jalanBelumSfo == 0)
                                    <span class="badge bg-success">
                                        <i class="fas fa-trophy me-1"></i> Target Tercapai!
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-clock me-1"></i> Dalam Pengerjaan
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Progress Bar -->
            <div class="col-md-12 mb-2">
                <div class="stat-card p-4">
                    <h5 class="text-uppercase text-muted fw-bold mb-3">PROGRESS SFO</h5>
                    <div class="progress mb-2" style="height: 25px;">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar"
                            style="width: {{ $progressPercentage }}%" aria-valuenow="{{ $progressPercentage }}"
                            aria-valuemin="0" aria-valuemax="100">
                            {{ number_format($progressPercentage, 1) }}%
                        </div>
                    </div>
                    <small class="text-muted">
                        Total Jalan: {{ number_format($totalPanjangJalan / 1000, 1) }} KM |
                        Tercapai: {{ $jalanSudahSfo }} KM |
                        Tersisa: {{ $jalanBelumSfo }} KM
                    </small>
                </div>
            </div>
        </div>

        <!-- Informasi Total -->
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="alert alert-info">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-2"></i>
                        <div>
                            <strong>Informasi:</strong> Total panjang jalan yang telah dikerjakan adalah
                            <strong>{{ $jalanSudahSfo }} KM</strong>.
                            @if ($jalanBelumSfo == 0)
                                <strong>Selamat! Semua jalan telah diselesaikan.</strong>
                            @else
                                Sisa jalan yang perlu dikerjakan adalah <strong>{{ $jalanBelumSfo }} KM</strong>.
                            @endif
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
                        <h5 class="fw-bold mb-0">GRAFIK SFO TAHUN {{ $tahun }}</h5>
                        <select id="tahunSelect"
                            class="form-select border-primary border-2 rounded-3 form-select-sm w-auto fw-semibold text-muted"
                            style="box-shadow:none;">
                            @for ($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
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

        .progress-bar {
            font-weight: 600;
            font-size: 14px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data dari controller
            const chartData = {
                labels: @json($grafikData['labels']),
                datasets: [{
                    label: 'KM',
                    data: @json($grafikData['data']),
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.3,
                    fill: true
                }]
            };

            const ctx = document.getElementById('sfoChart');
            if (ctx) {
                const chart = new Chart(ctx, {
                    type: 'line',
                    data: chartData,
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
                                    stepSize: 5,
                                    callback: function(value) {
                                        return value + ' KM';
                                    }
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

                document.getElementById('tahunSelect').addEventListener('change', function() {
                    const tahun = this.value;
                    window.location.href = "{{ route('dashboard') }}?tahun=" + tahun;
                });
            }
        });
    </script>
@endsection
