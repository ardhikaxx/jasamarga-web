@extends('layouts.app')

@section('title', 'Manajemen Lokasi Jalur Lajur')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-primary fw-bold">Manajemen Lokasi Jalur Lajur</h3>
                    <a href="{{ route('locations.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Lokasi
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Jalur</th>
                                <th>Lajur</th>
                                <th>Keterangan</th>
                                <th>Jumlah Aktivitas</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($locations as $index => $location)
                                <tr>
                                    <td>{{ ($locations->currentPage() - 1) * $locations->perPage() + $index + 1 }}</td>
                                    <td>{{ $location->jalur }}</td>
                                    <td>{{ $location->lajur }}</td>
                                    <td>{{ $location->keterangan ?? '-' }}</td>
                                    <td>{{ $location->aktivitasSfo->count() }}</td>
                                    <td>{{ $location->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('locations.destroy', $location->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data lokasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($locations->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Menampilkan {{ $locations->firstItem() }} - {{ $locations->lastItem() }} dari {{ $locations->total() }} data
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            {{-- Previous Page Link --}}
                            @if ($locations->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $locations->previousPageUrl() }}" rel="prev">&laquo;</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($locations->getUrlRange(1, $locations->lastPage()) as $page => $url)
                                @if ($page == $locations->currentPage())
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
                            @if ($locations->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $locations->nextPageUrl() }}" rel="next">&raquo;</a>
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

            // SweetAlert untuk notifikasi sukses
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2500,
                    background: '#DEF1FF',
                    color: '#0069ab',
                    iconColor: '#0095de',
                    customClass: {
                        popup: 'swal2-popup'
                    }
                });
            @endif

            // SweetAlert untuk notifikasi error
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 3000,
                    background: '#FFE6E6',
                    color: '#a30000',
                    iconColor: '#d33',
                    customClass: {
                        popup: 'swal2-popup'
                    }
                });
            @endif

            // SweetAlert untuk konfirmasi hapus
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Dapatkan jumlah aktivitas dari baris tabel
                    const activityCount = parseInt(this.closest('tr').querySelector('td:nth-child(5)').textContent);
                    
                    // Jika lokasi memiliki aktivitas, tampilkan peringatan
                    if (activityCount > 0) {
                        Swal.fire({
                            title: 'Tidak Dapat Dihapus',
                            html: `Lokasi ini memiliki <strong>${activityCount} aktivitas</strong> yang terkait. <br>Hapus semua aktivitas terlebih dahulu sebelum menghapus lokasi.`,
                            icon: 'warning',
                            confirmButtonColor: '#00a4f4',
                            confirmButtonText: 'Mengerti',
                            background: '#FFF9E6',
                            color: '#856404',
                            iconColor: '#f0ad4e',
                            customClass: {
                                popup: 'swal2-popup'
                            }
                        });
                        return;
                    }
                    
                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: 'Apakah Anda yakin ingin menghapus lokasi ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                        background: '#FFF0F0',
                        color: '#a30000',
                        iconColor: '#d33',
                        customClass: {
                            popup: 'swal2-popup',
                            confirmButton: 'btn-delete-confirm',
                            cancelButton: 'btn-delete-cancel'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection