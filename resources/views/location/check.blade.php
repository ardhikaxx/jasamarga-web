@extends('layouts.app')

@section('title', 'Check Location SFO')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-3 p-md-4">
                <h3 class="mb-3 mb-md-4 text-center text-primary fw-bold">CHECK LOCATION SFO</h3>
                <form>
                    <div class="row mb-2">
                        <div class="col-12 col-md-6 mb-1 mb-md-0">
                            <div class="form-group-header mb-2">
                                <img src="{{ asset('images/5736e074b2abdecf804d13fb256bcccc06761f0a.png') }}" alt=""
                                    class="form-icon">
                                <label for="lokasiAwal" class="form-label text-primary h5">Lokasi Awal</label>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="lokasiAwal"
                                    placeholder="Masukkan Lokasi Awal">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-group-header mb-2">
                                <img src="{{ asset('images/5736e074b2abdecf804d13fb256bcccc06761f0a.png') }}" alt=""
                                    class="form-icon">
                                <label for="lokasiAkhir" class="form-label text-primary h5">Lokasi Akhir</label>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="lokasiAkhir"
                                    placeholder="Masukkan Lokasi Akhir">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12 col-md-6 mb-1 mb-md-0">
                            <div class="form-group-header mb-2">
                                <img src="{{ asset('images/314_740.svg') }}" alt="" class="form-icon">
                                <label for="lajur" class="form-label text-primary h5">Lajur</label>
                            </div>
                            <select class="form-select" id="lajur" aria-label="Pilih Lajur">
                                <option selected disabled>Pilih Lajur</option>
                                <option value="1">Lajur 1</option>
                                <option value="2">Lajur 2</option>
                                <option value="3">Lajur 3</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group-header mb-2">
                                <img src="{{ asset('images/5736e074b2abdecf804d13fb256bcccc06761f0a.png') }}" alt=""
                                    class="form-icon">
                                <label for="tahun" class="form-label text-primary h5">Tahun</label>
                            </div>
                            <div class="input-group">
                                <select class="form-control" id="tahun" name="tahun">
                                    @for ($i = date('Y'); $i >= 2000; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3 mt-md-0">
                        {{-- <button type="submit" class="btn btn-primary px-4">Cek Lokasi<i class="bi bi-check-circle-fill fs-5 ms-2"></i></button> --}}
                        <a href="{{ route('location-sfo') }}" class="btn btn-primary px-4">Cek Lokasi<i
                                class="bi bi-check-circle-fill fs-5 ms-2"></i></a>
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
