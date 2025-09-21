<div class="container-fluid">
    <div class="card border-0">
        <div class="card-body p-0">
            <div class="d-flex justify-content-center align-items-center mb-5">
                <div class="canvas-wrapper">
                    <canvas id="sfoCanvas" width="1000" height="500" data-sta-awal="{{ $sfo->sta_awal }}"
                        data-sta-akhir="{{ $sfo->sta_akhir }}"
                        data-jalur="{{ $sfo->lokasi->jalur ?? 'Data tidak tersedia' }}"
                        data-lajur="{{ $sfo->lokasi->lajur ?? 'Data tidak tersedia' }}"
                        data-tanggal="{{ \Carbon\Carbon::parse($sfo->tanggal_sfo)->format('d-m-Y') }}"
                        data-work-type="{{ $sfo->jenisPekerjaan->nama_pekerjaan ?? 'Data tidak tersedia' }}">
                    </canvas>
                </div>
            </div>

            <div class="keterangan-sfo w-100 bg-light p-3 rounded">
                <h4 class="text-primary mb-3">Keterangan Data SFO</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="info-item bg-white p-2 rounded mb-2">
                            <span class="fw-bold text-secondary">Tanggal SFO:</span>
                            <span>{{ \Carbon\Carbon::parse($sfo->tanggal_sfo)->format('d-m-Y') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item bg-white p-2 rounded mb-2">
                            <span class="fw-bold text-secondary">Projek:</span>
                            <span>{{ $sfo->projek->nama_projek ?? 'Data tidak tersedia' }}</span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="info-item bg-white p-2 rounded mb-2">
                            <span class="fw-bold text-secondary">STA Awal:</span>
                            <span>{{ number_format($sfo->sta_awal) }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item bg-white p-2 rounded mb-2">
                            <span class="fw-bold text-secondary">STA Akhir:</span>
                            <span>{{ number_format($sfo->sta_akhir) }}</span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="info-item bg-white p-2 rounded mb-2">
                            <span class="fw-bold text-secondary">Lokasi:</span>
                            <span>{{ $sfo->lokasi->jalur ?? 'Data tidak tersedia' }} - Lajur
                                {{ $sfo->lokasi->lajur ?? 'Data tidak tersedia' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item bg-white p-2 rounded mb-2">
                            <span class="fw-bold text-secondary">Panjang (m):</span>
                            <span>{{ number_format($sfo->panjang, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="info-item bg-white p-2 rounded mb-2">
                            <span class="fw-bold text-secondary">Lebar (m):</span>
                            <span>{{ number_format($sfo->lebar, 2) }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item bg-white p-2 rounded mb-2">
                            <span class="fw-bold text-secondary">Luas (m²):</span>
                            <span>{{ number_format($sfo->luas, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="info-item bg-white p-2 rounded mb-2">
                            <span class="fw-bold text-secondary">Pekerjaan:</span>
                            <span>{{ $sfo->jenisPekerjaan->nama_pekerjaan ?? 'Data tidak tersedia' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-item bg-white p-2 rounded mb-2">
                            <span class="fw-bold text-secondary">Status:</span>
                            <span
                                class="badge bg-{{ $sfo->status == 'Done' ? 'success' : ($sfo->status == 'Process' ? 'warning' : 'secondary') }}">
                                {{ $sfo->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="info-item bg-white p-2 rounded mb-2">
                            <span class="fw-bold text-secondary">Notes:</span>
                            <span>{{ $sfo->notes ?? 'Tidak ada keterangan' }}</span>
                        </div>
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

    .canvas-wrapper {
        width: 100%;
        overflow-x: auto;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        background-color: #f8f9fa;
        padding: 20px;
    }

    .keterangan-sfo {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .info-item {
        margin-bottom: 10px;
        padding: 8px 12px;
        background-color: white;
        border-radius: 6px;
        border: 1px solid #e9ecef;
    }

    .badge {
        font-size: 0.9em;
        padding: 5px 10px;
    }
</style>
