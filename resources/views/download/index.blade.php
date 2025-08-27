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
                                <th>Status</th>
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
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit" data-id="1" data-location="KM 178-300" data-date="23-04-2025" data-description="Scraping Filling AC WC" data-status="Unprocessed">
                                        <i class="bi bi-pencil"></i>
                                    </button>
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
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit" data-id="2" data-location="KM 156-450" data-date="15-05-2025" data-description="Overlay AC WC" data-status="Process">
                                        <i class="bi bi-pencil"></i>
                                    </button>
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
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit" data-id="3" data-location="KM 138-250" data-date="07-06-2025" data-description="Scraping Filling AC WC" data-status="Done">
                                        <i class="bi bi-pencil"></i>
                                    </button>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Status SFO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="editId" name="id">
                        <div class="mb-3">
                            <label for="editLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" id="editLocation" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editDate" class="form-label">Date</label>
                            <input type="text" class="form-control" id="editDate" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" rows="2" readonly></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Status</label>
                            <select class="form-select" id="editStatus" name="status">
                                <option value="Unprocessed">Unprocessed</option>
                                <option value="Process">Process</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Simpan Perubahan</button>
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

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #e0a800;
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

    <script>
        // Inisialisasi tooltip Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
            
            // Event listener untuk tombol edit
            document.querySelectorAll('.btn-warning').forEach(button => {
                button.addEventListener('click', function() {
                    // Ambil data dari atribut data
                    const id = this.getAttribute('data-id');
                    const location = this.getAttribute('data-location');
                    const date = this.getAttribute('data-date');
                    const description = this.getAttribute('data-description');
                    const status = this.getAttribute('data-status');
                    
                    // Isi form modal dengan data yang diambil
                    document.getElementById('editId').value = id;
                    document.getElementById('editLocation').value = location;
                    document.getElementById('editDate').value = date;
                    document.getElementById('editDescription').value = description;
                    document.getElementById('editStatus').value = status;
                    
                    // Tampilkan modal edit
                    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                    editModal.show();
                });
            });
            
            // Event listener untuk tombol simpan
            document.getElementById('saveChanges').addEventListener('click', function() {
                // Ambil data dari form
                const id = document.getElementById('editId').value;
                const newStatus = document.getElementById('editStatus').value;
                
                // Di sini Anda bisa menambahkan kode untuk mengirim data ke server
                // menggunakan AJAX atau form submission
                console.log('Mengubah status SFO dengan ID:', id, 'menjadi:', newStatus);
                
                // Update badge status di tabel (contoh sederhana)
                const statusBadge = document.querySelector(`button[data-id="${id}"]`).closest('tr').querySelector('.badge');
                statusBadge.textContent = newStatus;
                
                // Ubah warna badge berdasarkan status
                statusBadge.classList.remove('bg-danger', 'bg-primary', 'bg-success');
                if (newStatus === 'Unprocessed') {
                    statusBadge.classList.add('bg-danger');
                } else if (newStatus === 'Process') {
                    statusBadge.classList.add('bg-primary');
                } else if (newStatus === 'Done') {
                    statusBadge.classList.add('bg-success');
                }
                
                // Tutup modal
                bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
                
                // Tampilkan notifikasi (opsional)
                alert('Status berhasil diperbarui!');
            });
        });
    </script>
@endsection
