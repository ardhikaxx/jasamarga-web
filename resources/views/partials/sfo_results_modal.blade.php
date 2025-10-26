<div class="container-fluid">
    <div class="card border-0">
        <div class="card-body p-0">
            <div class="alert alert-success mb-4">
                <i class="bi bi-check-circle me-2"></i>
                <strong>Berhasil!</strong> Ditemukan {{ $sfoActivities->count() }} data SFO untuk 
                <strong>STA {{ number_format($staValue) }}</strong>, Tahun <strong>{{ $tahun }}</strong>.
            </div>

            <div class="row">
                @foreach($sfoActivities as $sfo)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-{{ $sfo->sta_awal == $staValue && $sfo->sta_akhir == $staValue ? 'success' : ($sfo->sta_awal == $staValue ? 'info' : ($sfo->sta_akhir == $staValue ? 'warning' : 'primary')) }}">
                        <div class="card-header bg-{{ $sfo->sta_awal == $staValue && $sfo->sta_akhir == $staValue ? 'success' : ($sfo->sta_awal == $staValue ? 'info' : ($sfo->sta_akhir == $staValue ? 'warning' : 'primary')) }} text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Data SFO #{{ $loop->iteration }}</h6>
                            <div>
                                @if($sfo->sta_awal == $staValue && $sfo->sta_akhir == $staValue)
                                    <span class="badge bg-light text-dark">STA Tepat</span>
                                @elseif($sfo->sta_awal == $staValue)
                                    <span class="badge bg-light text-dark">STA Awal</span>
                                @elseif($sfo->sta_akhir == $staValue)
                                    <span class="badge bg-light text-dark">STA Akhir</span>
                                @else
                                    <span class="badge bg-light text-dark">Dalam Range</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="keterangan-sfo">
                                <!-- Informasi Proyek -->
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="info-item bg-light">
                                            <span class="fw-bold text-primary">Proyek:</span>
                                            <span>{{ $sfo->projek->nama_projek ?? 'Data tidak tersedia' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="info-item">
                                            <span class="fw-bold text-secondary">Tanggal SFO:</span>
                                            <span>{{ \Carbon\Carbon::parse($sfo->tanggal_sfo)->format('d-m-Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="info-item {{ $sfo->sta_awal == $staValue ? 'bg-success text-white' : '' }}">
                                            <span class="fw-bold {{ $sfo->sta_awal == $staValue ? 'text-white' : 'text-secondary' }}">STA Awal:</span>
                                            <span>{{ number_format($sfo->sta_awal) }}</span>
                                            @if($sfo->sta_awal == $staValue)
                                                <span class="badge bg-light text-dark ms-1">✓ Match</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item {{ $sfo->sta_akhir == $staValue ? 'bg-success text-white' : '' }}">
                                            <span class="fw-bold {{ $sfo->sta_akhir == $staValue ? 'text-white' : 'text-secondary' }}">STA Akhir:</span>
                                            <span>{{ number_format($sfo->sta_akhir) }}</span>
                                            @if($sfo->sta_akhir == $staValue)
                                                <span class="badge bg-light text-dark ms-1">✓ Match</span>
                                            @endif
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

                                <!-- Keterangan Pencarian -->
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="info-item bg-info text-white">
                                            <span class="fw-bold">Keterangan:</span>
                                            <span>
                                                @if($sfo->sta_awal == $staValue && $sfo->sta_akhir == $staValue)
                                                    <i class="bi bi-check-circle me-1"></i>STA input sama dengan STA awal dan akhir
                                                @elseif($sfo->sta_awal == $staValue)
                                                    <i class="bi bi-arrow-right-circle me-1"></i>STA input sama dengan STA awal
                                                @elseif($sfo->sta_akhir == $staValue)
                                                    <i class="bi bi-arrow-left-circle me-1"></i>STA input sama dengan STA akhir
                                                @else
                                                    <i class="bi bi-arrows-angle-contract me-1"></i>STA input berada dalam range STA {{ number_format($sfo->sta_awal) }} - {{ number_format($sfo->sta_akhir) }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <button type="button" class="btn btn-primary view-detail-btn" 
                                        data-sfo-id="{{ $sfo->id }}">
                                    <i class="bi bi-eye me-1"></i>Lihat Detail Lengkap
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Summary -->
            <div class="alert alert-light mt-4">
                <div class="row text-center">
                    <div class="col-md-3">
                        <div class="fw-bold text-primary">Total Data</div>
                        <div class="h4 text-primary">{{ $sfoActivities->count() }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="fw-bold text-success">STA Tepat</div>
                        <div class="h4 text-success">{{ $sfoActivities->where('sta_awal', $staValue)->where('sta_akhir', $staValue)->count() }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="fw-bold text-info">STA Awal</div>
                        <div class="h4 text-info">{{ $sfoActivities->where('sta_awal', $staValue)->where('sta_akhir', '!=', $staValue)->count() }}</div>
                    </div>
                    <div class="col-md-3">
                        <div class="fw-bold text-warning">STA Akhir</div>
                        <div class="h4 text-warning">{{ $sfoActivities->where('sta_akhir', $staValue)->where('sta_awal', '!=', $staValue)->count() }}</div>
                    </div>
                </div>
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

    .keterangan-sfo {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .info-item {
        margin-bottom: 8px;
        padding: 8px 12px;
        background-color: white;
        border-radius: 6px;
        border: 1px solid #e9ecef;
        font-size: 0.9em;
    }

    .badge {
        font-size: 0.75em;
        padding: 4px 8px;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        border-radius: 12px 12px 0 0 !important;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .col-md-6 {
            margin-bottom: 15px;
        }
        
        .info-item {
            font-size: 0.85em;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }
    }
</style>