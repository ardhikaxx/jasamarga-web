@extends('layouts.app')

@section('title', 'Hasil Pencarian Lokasi SFO')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <h3 class="mb-4 text-center text-primary fw-bold">Hasil Pencarian Lokasi SFO</h3>

                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Ditemukan {{ $sfoActivities->count() }} data SFO untuk STA {{ $staAwal }} - {{ $staAkhir }}, 
                    Jalur {{ $jalur }}, Tahun {{ $tahun }}
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal SFO</th>
                                <th>STA Awal</th>
                                <th>STA Akhir</th>
                                <th>Lokasi</th>
                                <th>Pekerjaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sfoActivities as $sfo)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($sfo->tanggal_sfo)->format('d-m-Y') }}</td>
                                    <td>{{ number_format($sfo->sta_awal) }}</td>
                                    <td>{{ number_format($sfo->sta_akhir) }}</td>
                                    <td>{{ $sfo->location->jalur }} - Lajur {{ $sfo->location->lajur }}</td>
                                    <td>{{ $sfo->workType->nama_pekerjaan }}</td>
                                    <td>
                                        <span class="badge bg-{{ $sfo->status == 'Done' ? 'success' : ($sfo->status == 'Process' ? 'warning' : 'secondary') }}">
                                            {{ $sfo->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('check-location.detail', $sfo->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye me-1"></i>Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('check-location') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-primary {
            background-color: #00a4f4;
            border-color: #00a4f4;
        }

        .btn-primary:hover {
            background-color: #008fd8;
            border-color: #008fd8;
        }

        .badge {
            font-size: 0.9em;
            padding: 5px 10px;
        }
    </style>
@endsection