@extends('layouts.app')

@section('title', 'Daftar SFO')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <h3 class="text-center text-primary fw-bold mb-4">Daftar SFO</h3>
                <div class="row mb-4 d-flex align-items-end">
                    <div class="col-md-2 mb-2 mb-md-0">
                        <label class="form-label">Pilih Tanggal Awal</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="tglAwal" value="2024-01-01">
                            <span class="input-group-text" onclick="document.getElementById('tglAwal').showPicker()">
                                <i class="bi bi-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 mb-2 mb-md-0">
                        <label class="form-label">Pilih Tanggal Akhir</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="tglAkhir" value="2024-02-01">
                            <span class="input-group-text" onclick="document.getElementById('tglAkhir').showPicker()">
                                <i class="bi bi-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 mb-2 mb-md-0">
                        <button class="btn btn-primary w-100">Filter</button>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                    </div>
                </div>
                <h5 class="mb-3">Data Table SFO</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>KM 178-300</td>
                                <td>23-04-2025</td>
                                <td>Scraping Filling AC WC</td>
                                <td>
                                    <span class="badge bg-danger">Unprocessed</span>
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>KM 156-450</td>
                                <td>15-05-2025</td>
                                <td>Overlay AC WC</td>
                                <td>
                                    <span class="badge bg-primary">Process</span>
                                </td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>KM 138-250</td>
                                <td>07-06-2025</td>
                                <td>Scraping Filling AC WC</td>
                                <td>
                                    <span class="badge bg-success">Done</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button class="btn btn-primary">
                        <i class="bi bi-download me-2"></i> Download
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Hilangkan icon kalender bawaan browser */
        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
        }

        /* Untuk Firefox */
        input[type="date"]::-moz-calendar-picker-indicator {
            display: none;
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

        .card-title {
            font-weight: 700;
            color: #3d3d3d;
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

        .badge {
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 600;
        }
    </style>
@endsection
