@extends('layouts.app')

@section('title', 'Tambah Jenis Pekerjaan Baru')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <h3 class="text-primary fw-bold mb-4">Tambah Jenis Pekerjaan Baru</h3>

                <form action="{{ route('work.store') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="nama_pekerjaan" class="form-label">Nama Pekerjaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_pekerjaan') is-invalid @enderror" 
                                id="nama_pekerjaan" name="nama_pekerjaan" value="{{ old('nama_pekerjaan') }}" required 
                                placeholder="Contoh: Scraping Filling AC WC">
                            @error('nama_pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                id="deskripsi" name="deskripsi" rows="4" 
                                placeholder="Tambahkan deskripsi pekerjaan (opsional)">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Maksimal 1000 karakter.</div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Simpan
                        </button>
                        <a href="{{ route('work.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #e7e7e7;
        }

        .form-control:focus {
            border-color: #00a4f4;
            box-shadow: 0 0 0 0.25rem rgba(0, 164, 244, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: #3d3d3d;
            margin-bottom: 8px;
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

        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
        }
    </style>
@endsection