@extends('layouts.app')

@section('title', 'Hasil Pencarian Lokasi SFO')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <h3 class="mb-4 text-center text-primary fw-bold">Hasil Pencarian Lokasi SFO</h3>

                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Ditemukan {{ $sfoActivities->count() }} data SFO untuk STA {{ $staValue }}, 
                    Tahun {{ $tahun }}
                </div>

                <div class="row">
                    @foreach($sfoActivities as $sfo)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Data SFO #{{ $loop->iteration }}</h5>
                                
                                <div class="keterangan-sfo">
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="fw-bold text-secondary">Tanggal SFO:</span>
                                                <span>{{ \Carbon\Carbon::parse($sfo->tanggal_sfo)->format('d-m-Y') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="fw-bold text-secondary">Projek:</span>
                                                <span>{{ $sfo->projek->nama_projek ?? 'Data tidak tersedia' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="fw-bold text-secondary">STA Awal:</span>
                                                <span>{{ number_format($sfo->sta_awal) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="fw-bold text-secondary">STA Akhir:</span>
                                                <span>{{ number_format($sfo->sta_akhir) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="fw-bold text-secondary">Lokasi:</span>
                                                <span>{{ ($sfo->lokasi->jalur ?? 'Data tidak tersedia') }} - Lajur {{ $sfo->lokasi->lajur ?? 'Data tidak tersedia' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="fw-bold text-secondary">Panjang (m):</span>
                                                <span>{{ number_format($sfo->panjang, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="fw-bold text-secondary">Lebar (m):</span>
                                                <span>{{ number_format($sfo->lebar, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="fw-bold text-secondary">Luas (m²):</span>
                                                <span>{{ number_format($sfo->luas, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="fw-bold text-secondary">Pekerjaan:</span>
                                                <span>{{ $sfo->jenisPekerjaan->nama_pekerjaan ?? 'Data tidak tersedia' }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="fw-bold text-secondary">Status:</span>
                                                <span class="badge bg-{{ $sfo->status == 'Done' ? 'success' : ($sfo->status == 'Process' ? 'warning' : 'secondary') }}">
                                                    {{ $sfo->status }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <div class="info-item">
                                                <span class="fw-bold text-secondary">Notes:</span>
                                                <span>{{ $sfo->notes ?? 'Tidak ada keterangan' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    <a href="{{ route('check-location.detail', $sfo->id) }}" class="btn btn-primary px-4">
                                        <i class="bi bi-eye me-2"></i>Lihat Detail Lengkap
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('check-location') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali Pencarian
                    </a>
                    
                    @if($sfoActivities->count() > 0)
                    <div class="alert alert-warning mb-0">
                        <small>
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Ditemukan {{ $sfoActivities->count() }} data SFO yang mencakup STA {{ $staValue }}. 
                            Pilih salah satu untuk melihat detail lengkap dengan visualisasi.
                        </small>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-primary {
            background-color: #00a4f4;
            border-color: #00a4f4;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #008fd8;
            border-color: #008fd8;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
        }

        .keterangan-sfo {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .info-item {
            margin-bottom: 8px;
            padding: 6px 10px;
            background-color: white;
            border-radius: 6px;
            border: 1px solid #e9ecef;
            font-size: 0.9em;
        }

        .badge {
            font-size: 0.8em;
            padding: 4px 8px;
        }

        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            border-bottom: 2px solid #00a4f4;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .col-md-6 {
                margin-bottom: 15px;
            }
            
            .info-item {
                font-size: 0.85em;
            }
        }
    </style>
@endsection