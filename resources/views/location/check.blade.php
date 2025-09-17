@extends('layouts.app')

@section('title', 'Check Location SFO')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-3 p-md-4">
                <h3 class="mb-3 mb-md-4 text-center text-primary fw-bold">CHECK LOCATION SFO</h3>
                
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
                
                <form method="POST" action="{{ route('check-location.process') }}">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-12 col-md-6 mb-1 mb-md-0">
                            <div class="form-group-header mb-2">
                                <img src="{{ asset('images/5736e074b2abdecf804d13fb256bcccc06761f0a.png') }}" alt=""
                                    class="form-icon">
                                <label for="lokasi_awal" class="form-label text-primary h5">Lokasi Awal</label>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control @error('lokasi_awal') is-invalid @enderror" 
                                    id="lokasi_awal" name="lokasi_awal" value="{{ old('lokasi_awal') }}"
                                    placeholder="Masukkan Lokasi Awal" required>
                                @error('lokasi_awal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group-header mb-2">
                                <img src="{{ asset('images/5736e074b2abdecf804d13fb256bcccc06761f0a.png') }}" alt=""
                                    class="form-icon">
                                <label for="lokasi_akhir" class="form-label text-primary h5">Lokasi Akhir</label>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control @error('lokasi_akhir') is-invalid @enderror" 
                                    id="lokasi_akhir" name="lokasi_akhir" value="{{ old('lokasi_akhir') }}"
                                    placeholder="Masukkan Lokasi Akhir" required>
                                @error('lokasi_akhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12 col-md-6 mb-1 mb-md-0">
                            <div class="form-group-header mb-2">
                                <img src="{{ asset('images/314_740.svg') }}" alt="" class="form-icon">
                                <label for="jalur_sfo" class="form-label text-primary h5">Jalur</label>
                            </div>
                            <select class="form-select @error('jalur_sfo') is-invalid @enderror" 
                                id="jalur_sfo" name="jalur_sfo" aria-label="Pilih Jalur" required>
                                <option value="" selected disabled>Pilih Jalur</option>
                                @foreach($jalurOptions as $jalur)
                                    <option value="{{ $jalur }}" {{ old('jalur_sfo') == $jalur ? 'selected' : '' }}>
                                        {{ $jalur }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jalur_sfo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group-header mb-2">
                                <img src="{{ asset('images/5736e074b2abdecf804d13fb256bcccc06761f0a.png') }}" alt=""
                                    class="form-icon">
                                <label for="tahun" class="form-label text-primary h5">Tahun</label>
                            </div>
                            <div class="input-group">
                                <select class="form-control @error('tahun') is-invalid @enderror" 
                                    id="tahun" name="tahun" required>
                                    <option value="" selected disabled>Pilih Tahun</option>
                                    @for ($i = date('Y'); $i >= 2000; $i--)
                                        <option value="{{ $i }}" {{ old('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3 mt-md-0">
                        <button type="submit" class="btn btn-primary px-4">Cek Lokasi<i class="bi bi-check-circle-fill fs-5 ms-2"></i></button>
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

        @media (max-width: 768px) {
            .card-body {
                padding: 20px 15px;
            }

            .form-group-header {
                margin-top: 15px;
            }

            .input-group,
            .form-select {
                margin-bottom: 10px;
            }

            .btn-primary {
                width: 100%;
                margin-top: 15px;
            }

            .d-flex.justify-content-end {
                justify-content: center !important;
            }
        }
    </style>
@endsection
