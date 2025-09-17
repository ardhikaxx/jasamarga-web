@extends('layouts.app')

@section('title', 'Input Location SFO')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <h3 class="mb-4 text-center text-primary fw-bold">INPUT LOCATION SFO</h3>

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Error Message --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('input-location.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="lokasi_awal" class="form-label text-secondary h5">Lokasi SFO</label>
                            <div class="d-flex justify-content-center align-items-center gap-4 flex-md-row flex-column">
                                <div class="input-group">
                                    <input type="text" class="form-control @error('lokasi_awal') is-invalid @enderror"
                                        id="lokasi_awal" name="lokasi_awal" value="{{ old('lokasi_awal') }}"
                                        placeholder="Masukan Lokasi Awal" required>
                                    @error('lokasi_awal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('lokasi_akhir') is-invalid @enderror"
                                        id="lokasi_akhir" name="lokasi_akhir" value="{{ old('lokasi_akhir') }}"
                                        placeholder="Masukan Lokasi Akhir" required>
                                    @error('lokasi_akhir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="posisi_jalur_awal" class="form-label text-secondary h5">Posisi SFO</label>
                            <div class="d-flex justify-content-center align-items-center gap-4 flex-md-row flex-column">
                                <div class="input-group">
                                    <input type="text" class="form-control @error('posisi_awal') is-invalid @enderror"
                                        id="posisi_awal" name="posisi_awal" value="{{ old('posisi_awal') }}"
                                        placeholder="Masukan Posisi Jalur Awal" required>
                                    @error('posisi_awal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('posisi_akhir') is-invalid @enderror"
                                        id="posisi_akhir" name="posisi_akhir" value="{{ old('posisi_akhir') }}"
                                        placeholder="Masukan Posisi Jalur Akhir" required>
                                    @error('posisi_akhir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="panjang" class="form-label text-secondary h5">Panjang SFO</label>
                            <div class="input-group">
                                <input type="number" step="0.01"
                                    class="form-control @error('panjang') is-invalid @enderror" id="panjang"
                                    name="panjang" value="{{ old('panjang') }}" placeholder="Masukan Panjang (m)" required>
                                <span class="input-group-text">m</span>
                                @error('panjang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="lebar" class="form-label text-secondary h5">Lebar SFO</label>
                            <div class="input-group">
                                <input type="number" step="0.01"
                                    class="form-control @error('lebar') is-invalid @enderror" id="lebar" name="lebar"
                                    value="{{ old('lebar') }}" placeholder="Masukan Lebar Rata-rata (m)" required>
                                <span class="input-group-text">m</span>
                                @error('lebar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="tebal" class="form-label text-secondary h5">Tebal SFO</label>
                            <div class="input-group">
                                <input type="number" step="0.01"
                                    class="form-control @error('tebal') is-invalid @enderror" id="tebal" name="tebal"
                                    value="{{ old('tebal') }}" placeholder="Masukan Tebal" required>
                                <span class="input-group-text">m</span>
                                @error('tebal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="luas" class="form-label text-secondary h5">Luas SFO</label>
                            <div class="input-group">
                                <input type="number" step="0.01"
                                    class="form-control @error('luas') is-invalid @enderror" id="luas"
                                    name="luas" value="{{ old('luas') }}" placeholder="Masukan Luas (m²)" required>
                                <span class="input-group-text">m²</span>
                                @error('luas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="tanggal_sfo" class="form-label text-secondary h5">Tanggal SFO</label>
                            <div class="input-group">
                                <input type="date" class="form-control @error('tanggal_sfo') is-invalid @enderror"
                                    id="tanggal_sfo" name="tanggal_sfo" value="{{ old('tanggal_sfo') }}"
                                    placeholder="Pilih Tanggal SFO" required>
                                @error('tanggal_sfo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="jalur_sfo" class="form-label text-secondary h5">Jalur SFO</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('jalur_sfo') is-invalid @enderror"
                                    id="jalur_sfo" name="jalur_sfo" value="{{ old('jalur_sfo') }}"
                                    placeholder="Masukkan Jalur SFO" required>
                                @error('jalur_sfo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label text-secondary h5">Keterangan</label>
                            <div class="input-group">
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                    placeholder="Deskripsikan Keterangan" rows="3">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Upload <i class="bi bi-check-circle-fill fs-5 ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .form-group-header {
            display: flex;
            align-items: center;
            justify-content: start;
            margin-bottom: 8px;
            gap: 8px;
        }

        .form-icon {
            width: 26px;
            height: 26px;
        }

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

        .btn-outline-secondary {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
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
    </style>
@endsection
