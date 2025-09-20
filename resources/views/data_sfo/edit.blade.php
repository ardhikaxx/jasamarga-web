@extends('layouts.app')

@section('title', 'Edit Data SFO')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <h3 class="mb-4 text-center text-primary fw-bold">EDIT DATA SFO</h3>

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Error Message --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('sfo.update', $sfo->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="project_id" class="form-label text-secondary h5">Projek <span class="text-danger">*</span></label>
                            <select class="form-control @error('project_id') is-invalid @enderror" id="project_id" name="project_id" required>
                                <option value="" disabled>Pilih Projek</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id', $sfo->project_id) == $project->id ? 'selected' : '' }}>
                                        {{ $project->nama_projek }} ({{ $project->tahun_projek }})
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="tanggal_sfo" class="form-label text-secondary h5">Tanggal SFO <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_sfo') is-invalid @enderror" 
                                id="tanggal_sfo" name="tanggal_sfo" value="{{ old('tanggal_sfo', $sfo->tanggal_sfo->format('Y-m-d')) }}" required>
                            @error('tanggal_sfo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="sta_awal" class="form-label text-secondary h5">STA Awal <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('sta_awal') is-invalid @enderror" 
                                id="sta_awal" name="sta_awal" value="{{ old('sta_awal', $sfo->sta_awal) }}" 
                                placeholder="Masukkan STA Awal" min="0" required>
                            @error('sta_awal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="sta_akhir" class="form-label text-secondary h5">STA Akhir <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('sta_akhir') is-invalid @enderror" 
                                id="sta_akhir" name="sta_akhir" value="{{ old('sta_akhir', $sfo->sta_akhir) }}" 
                                placeholder="Masukkan STA Akhir" min="0" required>
                            @error('sta_akhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="location_id" class="form-label text-secondary h5">Lokasi <span class="text-danger">*</span></label>
                            <select class="form-control @error('location_id') is-invalid @enderror" id="location_id" name="location_id" required>
                                <option value="" disabled>Pilih Lokasi</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id', $sfo->location_id) == $location->id ? 'selected' : '' }}>
                                        {{ $location->jalur }} - {{ $location->lajur }} 
                                        @if($location->keterangan)
                                            ({{ $location->keterangan }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('location_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="panjang" class="form-label text-secondary h5">Panjang (m) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control @error('panjang') is-invalid @enderror" 
                                    id="panjang" name="panjang" value="{{ old('panjang', $sfo->panjang) }}" 
                                    placeholder="0.00" min="0.01" required oninput="calculateLuas()">
                                <span class="input-group-text">m</span>
                                @error('panjang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="lebar" class="form-label text-secondary h5">Lebar (m) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control @error('lebar') is-invalid @enderror" 
                                    id="lebar" name="lebar" value="{{ old('lebar', $sfo->lebar) }}" 
                                    placeholder="0.00" min="0.01" required oninput="calculateLuas()">
                                <span class="input-group-text">m</span>
                                @error('lebar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="tebal" class="form-label text-secondary h5">Tebal (m) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control @error('tebal') is-invalid @enderror" 
                                    id="tebal" name="tebal" value="{{ old('tebal', $sfo->tebal) }}" 
                                    placeholder="0.00" min="0.01" required>
                                <span class="input-group-text">m</span>
                                @error('tebal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="luas" class="form-label text-secondary h5">Luas (m²) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control @error('luas') is-invalid @enderror" 
                                    id="luas" name="luas" value="{{ old('luas', $sfo->luas) }}" 
                                    placeholder="0.00" min="0.01" required readonly>
                                <span class="input-group-text">m²</span>
                                @error('luas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">Luas dihitung otomatis dari panjang × lebar</div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="work_type_id" class="form-label text-secondary h5">Jenis Pekerjaan <span class="text-danger">*</span></label>
                            <select class="form-control @error('work_type_id') is-invalid @enderror" id="work_type_id" name="work_type_id" required>
                                <option value="" disabled>Pilih Jenis Pekerjaan</option>
                                @foreach($workTypes as $workType)
                                    <option value="{{ $workType->id }}" {{ old('work_type_id', $sfo->work_type_id) == $workType->id ? 'selected' : '' }}>
                                        {{ $workType->nama_pekerjaan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('work_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="status" class="form-label text-secondary h5">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="Unprocessed" {{ old('status', $sfo->status) == 'Unprocessed' ? 'selected' : '' }}>Unprocessed</option>
                                <option value="Process" {{ old('status', $sfo->status) == 'Process' ? 'selected' : '' }}>Process</option>
                                <option value="Done" {{ old('status', $sfo->status) == 'Done' ? 'selected' : '' }}>Done</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label for="notes" class="form-label text-secondary h5">Catatan</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" 
                                placeholder="Tambahkan catatan (opsional)" rows="3">{{ old('notes', $sfo->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('sfo.index') }}" class="btn btn-secondary px-4">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle-fill me-2"></i>Update Data
                        </button>
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

        .form-control,
        .form-select,
        .input-group-text {
            border-radius: 8px;
        }

        .form-control,
        .form-select {
            padding: 10px 15px;
            border: 1px solid #e7e7e7;
        }

        .form-control:focus,
        .form-select:focus {
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

        .input-group-text {
            background-color: #f8f9fa;
            color: #6d6d6d;
            border: 1px solid #e7e7e7;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .form-text {
            font-size: 0.875rem;
            color: #6c757d;
        }
    </style>

    <script>
        function calculateLuas() {
            const panjang = parseFloat(document.getElementById('panjang').value) || 0;
            const lebar = parseFloat(document.getElementById('lebar').value) || 0;
            const luas = panjang * lebar;
            
            document.getElementById('luas').value = luas.toFixed(2);
        }

        // Inisialisasi perhitungan luas saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            calculateLuas();
            
            // Validasi STA Akhir harus >= STA Awal
            document.getElementById('sta_akhir').addEventListener('change', function() {
                const staAwal = parseInt(document.getElementById('sta_awal').value) || 0;
                const staAkhir = parseInt(this.value) || 0;
                
                if (staAkhir < staAwal) {
                    alert('STA Akhir harus lebih besar atau sama dengan STA Awal');
                    this.value = staAwal;
                }
            });
        });
    </script>
@endsection