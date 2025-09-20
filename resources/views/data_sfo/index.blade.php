@extends('layouts.app')

@section('title', 'Manajemen Data SFO')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-primary fw-bold">Manajemen Data SFO</h3>
                    <div class="d-flex justify-content-end mt-3 gap-3">
                        <a href="{{ route('sfo.download', request()->all()) }}" class="btn btn-primary">
                            <i class="bi bi-download me-2"></i> Download CSV
                        </a>
                        <a href="{{ route('sfo.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Data SFO
                        </a>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('sfo.index') }}" method="GET" class="mb-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Pilih Filter</label>
                            <select class="form-select" name="filter_type" id="filterSelect">
                                <option value="">-- Semua Data --</option>
                                <option value="pertanggal" {{ request('filter_type') == 'pertanggal' ? 'selected' : '' }}>
                                    Pertanggal</option>
                                <option value="perbulan" {{ request('filter_type') == 'perbulan' ? 'selected' : '' }}>
                                    Perbulan</option>
                                <option value="pertahun" {{ request('filter_type') == 'pertahun' ? 'selected' : '' }}>
                                    Pertahun</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="filterContainer">
                            @if (request('filter_type') == 'pertanggal')
                                <div class="row g-2">
                                    <div class="col">
                                        <label class="form-label">Tanggal Awal</label>
                                        <input type="date" class="form-control" name="tgl_awal"
                                            value="{{ request('tgl_awal') }}">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Tanggal Akhir</label>
                                        <input type="date" class="form-control" name="tgl_akhir"
                                            value="{{ request('tgl_akhir') }}">
                                    </div>
                                </div>
                            @elseif(request('filter_type') == 'perbulan')
                                <div class="row g-2">
                                    <div class="col">
                                        <label class="form-label">Bulan</label>
                                        <input type="month" class="form-control" name="bulan"
                                            value="{{ request('bulan') }}">
                                    </div>
                                </div>
                            @elseif(request('filter_type') == 'pertahun')
                                <div class="row g-2">
                                    <div class="col">
                                        <label class="form-label">Tahun</label>
                                        <select class="form-select" name="tahun">
                                            <option value="">Pilih Tahun</option>
                                            @for ($i = date('Y'); $i >= 2020; $i--)
                                                <option value="{{ $i }}"
                                                    {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-funnel me-2"></i>Terapkan Filter
                            </button>
                        </div>
                    </div>
                </form>

                <form action="{{ route('sfo.index') }}" method="GET" class="mb-4">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <label class="form-label fw-bold">Pencarian</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" name="search" placeholder="Cari data..."
                                    value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-outline-primary w-100">Cari</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Projek</th>
                                <th>STA Awal</th>
                                <th>STA Akhir</th>
                                <th>Lokasi</th>
                                <th>Panjang (m)</th>
                                <th>Lebar (m)</th>
                                <th>Luas (m²)</th>
                                <th>Pekerjaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sfoActivities as $index => $sfo)
                                <tr>
                                    <td>{{ ($sfoActivities->currentPage() - 1) * $sfoActivities->perPage() + $index + 1 }}
                                    </td>
                                    <td>{{ $sfo->tanggal_sfo->format('d-m-Y') }}</td>
                                    <td>{{ $sfo->projek->nama_projek }}</td>
                                    <td>{{ $sfo->sta_awal }}</td>
                                    <td>{{ $sfo->sta_akhir }}</td>
                                    <td>{{ $sfo->lokasi->jalur }} - {{ $sfo->lokasi->lajur }}</td>
                                    <td>{{ number_format($sfo->panjang, 2) }}</td>
                                    <td>{{ number_format($sfo->lebar, 2) }}</td>
                                    <td>{{ number_format($sfo->luas, 2) }}</td>
                                    <td>{{ $sfo->jenisPekerjaan->nama_pekerjaan }}</td>
                                    <td>
                                        <span
                                            class="badge 
                                            @if ($sfo->status == 'Unprocessed') bg-danger
                                            @elseif($sfo->status == 'Process') bg-warning
                                            @elseif($sfo->status == 'Done') bg-success @endif">
                                            {{ $sfo->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('sfo.edit', $sfo->id) }}" class="btn btn-warning btn-sm"
                                                data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('sfo.destroy', $sfo->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="tooltip" title="Hapus"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data SFO ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center">Tidak ada data SFO.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($sfoActivities->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Menampilkan {{ $sfoActivities->firstItem() }} - {{ $sfoActivities->lastItem() }} dari
                            {{ $sfoActivities->total() }} data
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination mb-0">
                                {{-- Previous Page Link --}}
                                @if ($sfoActivities->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $sfoActivities->previousPageUrl() }}"
                                            rel="prev">&laquo;</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($sfoActivities->getUrlRange(1, $sfoActivities->lastPage()) as $page => $url)
                                    @if ($page == $sfoActivities->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($sfoActivities->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $sfoActivities->nextPageUrl() }}"
                                            rel="next">&raquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">&raquo;</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

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

        table {
            border-radius: 8px;
            overflow: hidden;
        }

        thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #3d3d3d;
            padding: 12px 15px;
        }

        tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .btn-group .btn {
            margin-right: 5px;
            border-radius: 6px;
        }

        .badge {
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 600;
        }

        /* Pagination Styles */
        .pagination {
            border-radius: 8px;
        }

        .page-link {
            color: #00a4f4;
            border: 1px solid #dee2e6;
            padding: 0.5rem 0.75rem;
            margin: 0 2px;
            border-radius: 6px;
        }

        .page-item.active .page-link {
            background-color: #00a4f4;
            border-color: #00a4f4;
        }

        .page-link:hover {
            color: #008fd8;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            background-color: #fff;
            border-color: #dee2e6;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterSelect = document.getElementById('filterSelect');
            const filterContainer = document.getElementById('filterContainer');

            function updateFilterFields() {
                const value = filterSelect.value;
                let html = '';

                switch (value) {
                    case 'pertanggal':
                        html = `
                            <div class="row g-2">
                                <div class="col">
                                    <label class="form-label">Tanggal Awal</label>
                                    <input type="date" class="form-control" name="tgl_awal" value="{{ request('tgl_awal') }}">
                                </div>
                                <div class="col">
                                    <label class="form-label">Tanggal Akhir</label>
                                    <input type="date" class="form-control" name 'tgl_akhir' value="{{ request('tgl_akhir') }}">
                                </div>
                            </div>
                        `;
                        break;
                    case 'perbulan':
                        html = `
                            <div class="row g-2">
                                <div class="col">
                                    <label class="form-label">Bulan</label>
                                    <input type="month" class="form-control" name="bulan" value="{{ request('bulan') }}">
                                </div>
                            </div>
                        `;
                        break;
                    case 'pertahun':
                        html = `
                            <div class="row g-2">
                                <div class="col">
                                    <label class="form-label">Tahun</label>
                                    <select class="form-select" name="tahun">
                                        <option value="">Pilih Tahun</option>
                                        @for ($i = date('Y'); $i >= 2020; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        `;
                        break;
                }

                filterContainer.innerHTML = html;
            }

            filterSelect.addEventListener('change', updateFilterFields);

            // Inisialisasi tooltip
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection
