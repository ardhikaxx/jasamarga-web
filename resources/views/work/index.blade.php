@php
use Illuminate\Support\Str;
@endphp
@extends('layouts.app')

@section('title', 'Manajemen Jenis Pekerjaan')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-primary fw-bold">Manajemen Jenis Pekerjaan</h3>
                    <a href="{{ route('work.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Pekerjaan
                    </a>
                </div>

                <!-- Hapus alert biasa -->
                <!-- @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif -->

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Pekerjaan</th>
                                <th>Deskripsi</th>
                                <th>Jumlah Aktivitas</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($workTypes as $index => $work)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $work->nama_pekerjaan }}</td>
                                    <td>{{ $work->deskripsi ? Str::limit($work->deskripsi, 100) : '-' }}</td>
                                    <td>{{ $work->aktivitasSfo->count() }}</td>
                                    <td>{{ $work->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('work.edit', $work->id) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('work.destroy', $work->id) }}" method="POST" class="d-inline delete-form">
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
                                    <td colspan="6" class="text-center">Tidak ada data jenis pekerjaan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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
                    const activityCount = parseInt(this.closest('tr').querySelector('td:nth-child(4)').textContent);
                    
                    // Jika jenis pekerjaan memiliki aktivitas, tampilkan peringatan
                    if (activityCount > 0) {
                        Swal.fire({
                            title: 'Tidak Dapat Dihapus',
                            html: `Jenis pekerjaan ini memiliki <strong>${activityCount} aktivitas</strong> yang terkait. <br>Hapus semua aktivitas terlebih dahulu sebelum menghapus jenis pekerjaan.`,
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
                        text: 'Apakah Anda yakin ingin menghapus jenis pekerjaan ini?',
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