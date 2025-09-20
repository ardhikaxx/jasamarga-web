@extends('layouts.app')

@section('title', 'Manajemen Projek')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-primary fw-bold">Manajemen Projek</h3>
                    <a href="{{ route('projects.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Projek
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Projek</th>
                                <th>Lokasi</th>
                                <th>Tahun Projek</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $index => $project)
                                <tr>
                                    <td>{{ ($projects->currentPage() - 1) * $projects->perPage() + $index + 1 }}</td>
                                    <td>{{ $project->nama_projek }}</td>
                                    <td>{{ $project->lokasi }}</td>
                                    <td>{{ $project->tahun_projek }}</td>
                                    <td>{{ $project->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus projek ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data projek.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($projects->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Menampilkan {{ $projects->firstItem() }} - {{ $projects->lastItem() }} dari {{ $projects->total() }} data
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            {{-- Previous Page Link --}}
                            @if ($projects->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $projects->previousPageUrl() }}" rel="prev">&laquo;</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                                @if ($page == $projects->currentPage())
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
                            @if ($projects->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $projects->nextPageUrl() }}" rel="next">&raquo;</a>
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
            // Inisialisasi tooltip
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
@endsection