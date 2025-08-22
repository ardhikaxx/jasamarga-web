@extends('layouts.app')

@section('title', 'Input Location SFO')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <h3 class="mb-4 text-center text-primary fw-bold">INPUT LOCATION SFO</h3>
                <form method="POST" action="">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="lokasi_awal" class="form-label text-secondary h5">Lokasi SFO</label>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="lokasi_awal" name="lokasi_awal"
                                        placeholder="Masukan Lokasi Awal">
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="lokasi_akhir" name="lokasi_akhir"
                                        placeholder="Masukan Lokasi Akhir">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="posisi_jalur_awal" class="form-label text-secondary h5">Posisi SFO</label>
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="posisi_jalur_awal"
                                        name="posisi_jalur_awal" placeholder="Masukan Posisi Jalur Awal">
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="posisi_jalur_akhir"
                                        name="posisi_jalur_akhir" placeholder="Masukan Posisi Jalur Akhir">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="panjang" class="form-label text-secondary h5">Panjang SFO</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="panjang" name="panjang"
                                    placeholder="Masukan Panjang (m)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="lebar" class="form-label text-secondary h5">Lebar SFO</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="lebar" name="lebar"
                                    placeholder="Masukan Lebar Rata-rata (m)">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tebal" class="form-label text-secondary h5">Tebal SFO</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="tebal" name="tebal"
                                    placeholder="Masukan Tebal">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="luas" class="form-label text-secondary h5">Luas SFO</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="luas" name="luas"
                                    placeholder="Masukan Luas (m²)">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="tanggal_sfo" class="form-label text-secondary h5">Tanggal SFO</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="tanggal_sfo" name="tanggal_sfo"
                                    placeholder="Pilih Tanggal SFO">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label text-secondary h5">Keterangan</label>
                            <div class="input-group">
                                <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Deskripsikan Keterangan" rows="3"></textarea>
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
    </style>
@endsection
