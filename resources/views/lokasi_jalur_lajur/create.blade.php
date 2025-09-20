@extends('layouts.app')

@section('title', 'Tambah Lokasi Baru')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <h3 class="text-primary fw-bold mb-4">Tambah Lokasi Baru</h3>

                <form action="{{ route('locations.store') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jalur" class="form-label">Jalur <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('jalur') is-invalid @enderror" 
                                id="jalur" name="jalur" value="{{ old('jalur') }}" required 
                                placeholder="Contoh: Jalur A">
                            @error('jalur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="lajur" class="form-label">Lajur <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('lajur') is-invalid @enderror" 
                                id="lajur" name="lajur" value="{{ old('lajur') }}" required 
                                placeholder="Contoh: Lajur 1">
                            @error('lajur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror" 
                                id="keterangan" name="keterangan" rows="3" 
                                placeholder="Tambahkan keterangan lokasi (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>Simpan
                        </button>
                        <a href="{{ route('locations.index') }}" class="btn btn-secondary d-flex justify-content-center align-items-center">
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
    </style>
@endsection