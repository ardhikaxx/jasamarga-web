@extends('layouts.app')

@section('title', 'Cek Lokasi SFO')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-3 p-md-4">
                <h3 class="mb-3 mb-md-4 text-center text-primary fw-bold">Cek Lokasi SFO</h3>
                
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
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group-header mb-2">
                                <img src="{{ asset('images/5736e074b2abdecf804d13fb256bcccc06761f0a.png') }}" alt=""
                                    class="form-icon">
                                <label for="sta" class="form-label text-primary h5">STA (meter)</label>
                            </div>
                            <div class="input-group">
                                <input type="number" class="form-control @error('sta') is-invalid @enderror" 
                                    id="sta" name="sta" value="{{ old('sta') }}"
                                    placeholder="Masukkan STA dalam meter" required>
                                <span class="input-group-text">m</span>
                                @error('sta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                Contoh: 756505 untuk STA 756+505
                            </small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="form-group-header mb-2">
                                <img src="{{ asset('images/5736e074b2abdecf804d13fb256bcccc06761f0a.png') }}" alt=""
                                    class="form-icon">
                                <label for="tahun" class="form-label text-primary h5">Tahun Projek</label>
                            </div>
                            <select class="form-select @error('tahun') is-invalid @enderror" 
                                id="tahun" name="tahun" required>
                                <option value="" selected disabled>Pilih Tahun Projek</option>
                                @foreach($tahunOptions as $tahun)
                                    <option value="{{ $tahun }}" {{ old('tahun') == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-search me-2"></i>Cek Lokasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* CSS tetap sama */
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

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .form-text {
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