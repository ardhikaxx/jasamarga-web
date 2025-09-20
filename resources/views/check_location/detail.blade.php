@extends('layouts.app')

@section('title', 'Detail Lokasi SFO')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <h3 class="mb-4 text-center text-primary fw-bold">Detail Lokasi SFO</h3>

                <div class="d-flex justify-content-center align-items-center mb-5">
                    <div class="canvas-wrapper">
                        <canvas id="sfoCanvas" width="1000" height="500"></canvas>
                    </div>
                </div>

                <div class="keterangan-sfo w-100">
                    <h4 class="text-primary mb-3">Keterangan Data SFO</h4>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="fw-bold text-secondary">Tanggal SFO:</span>
                                <span>{{ \Carbon\Carbon::parse($sfo->tanggal_sfo)->format('d-m-Y') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="fw-bold text-secondary">Projek:</span>
                                <span>{{ $sfo->projek->nama_projek ?? 'Data tidak tersedia' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="fw-bold text-secondary">STA Awal:</span>
                                <span>{{ number_format($sfo->sta_awal) }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="fw-bold text-secondary">STA Akhir:</span>
                                <span>{{ number_format($sfo->sta_akhir) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="fw-bold text-secondary">Lokasi:</span>
                                <span>{{ ($sfo->lokasi->jalur ?? 'Data tidak tersedia') }} - Lajur {{ $sfo->lokasi->lajur ?? 'Data tidak tersedia' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="fw-bold text-secondary">Panjang (m):</span>
                                <span>{{ number_format($sfo->panjang, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="fw-bold text-secondary">Lebar (m):</span>
                                <span>{{ number_format($sfo->lebar, 2) }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="fw-bold text-secondary">Luas (m²):</span>
                                <span>{{ number_format($sfo->luas, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="fw-bold text-secondary">Pekerjaan:</span>
                                <span>{{ $sfo->jenisPekerjaan->nama_pekerjaan ?? 'Data tidak tersedia' }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <span class="fw-bold text-secondary">Status:</span>
                                <span class="badge bg-{{ $sfo->status == 'Done' ? 'success' : ($sfo->status == 'Process' ? 'warning' : 'secondary') }}">
                                    {{ $sfo->status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="info-item">
                                <span class="fw-bold text-secondary">Notes:</span>
                                <span>{{ $sfo->notes ?? 'Tidak ada keterangan' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('check-location') }}" class="btn btn-primary px-4">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
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

        .canvas-wrapper {
            width: 100%;
            overflow-x: auto;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .keterangan-sfo {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .info-item {
            margin-bottom: 10px;
            padding: 8px 12px;
            background-color: white;
            border-radius: 6px;
            border: 1px solid #e9ecef;
        }

        .badge {
            font-size: 0.9em;
            padding: 5px 10px;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const canvas = document.getElementById("sfoCanvas");
            const ctx = canvas.getContext("2d");

            // Data dari database
            const staAwal = {{ $sfo->sta_awal }};
            const staAkhir = {{ $sfo->sta_akhir }};
            const jalur = "{{ $sfo->lokasi->jalur ?? 'Data tidak tersedia' }}";
            const lajur = "{{ $sfo->lokasi->lajur ?? 'Data tidak tersedia' }}";
            const tahun = "{{ \Carbon\Carbon::parse($sfo->tanggal_sfo)->format('Y') }}";
            const projectName = "{{ $sfo->projek->nama_projek ?? 'Data tidak tersedia' }}";
            const workType = "{{ $sfo->jenisPekerjaan->nama_pekerjaan ?? 'Data tidak tersedia' }}";

            // Clear canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Draw background
            ctx.fillStyle = "#f8f9fa";
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            // Draw info box
            ctx.fillStyle = "#ffffff";
            ctx.strokeStyle = "#00a4f4";
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.rect(50, 70, canvas.width - 90, 90);
            ctx.fill();
            ctx.stroke();

            // Draw info text
            ctx.fillStyle = "#000";
            ctx.font = "14px Arial";
            ctx.textAlign = "left";
            
            // Row 2 - Tahun, Jalur, Lajur, STA
            ctx.fillText(`Jalur: ${jalur}`, 70, 110);
            ctx.fillText(`Lajur: ${lajur}`, 300, 110);
            ctx.fillText(`STA: ${staAwal} - ${staAkhir}`, 600, 110);

            // Row 3 - Tanggal dan Pekerjaan
            ctx.fillText(`Tanggal: {{ \Carbon\Carbon::parse($sfo->tanggal_sfo)->format('d-m-Y') }}`, 70, 135);
            ctx.fillText(`Pekerjaan: ${workType}`, 300, 135);

            // Draw road background
            const roadY = 200;
            const roadHeight = 100;
            const roadStartX = 100;
            const roadWidth = 800;

            ctx.fillStyle = "#e9ecef";
            ctx.fillRect(roadStartX - 20, roadY - 30, roadWidth + 40, roadHeight + 60);

            // Draw road
            ctx.fillStyle = "#6c757d";
            ctx.fillRect(roadStartX, roadY, roadWidth, roadHeight);

            // Draw lane markers
            ctx.strokeStyle = "#ffffff";
            ctx.lineWidth = 3;
            ctx.setLineDash([15, 25]);
            
            for (let i = 1; i < 4; i++) {
                const laneX = roadStartX + (i * (roadWidth / 4));
                ctx.beginPath();
                ctx.moveTo(laneX, roadY);
                ctx.lineTo(laneX, roadY + roadHeight);
                ctx.stroke();
            }

            // Draw SFO section
            const startPercent = (staAwal % 1000) / 1000;
            const endPercent = (staAkhir % 1000) / 1000;
            const startX = roadStartX + (startPercent * roadWidth);
            const endX = roadStartX + (endPercent * roadWidth);
            const sfoWidth = endX - startX;

            ctx.fillStyle = "#007bff";
            ctx.fillRect(startX, roadY, sfoWidth, roadHeight);

            // Draw SFO border
            ctx.strokeStyle = "#0056b3";
            ctx.lineWidth = 2;
            ctx.setLineDash([]);
            ctx.strokeRect(startX, roadY, sfoWidth, roadHeight);

            // Draw SFO label
            ctx.fillStyle = "#ffffff";
            ctx.font = "bold 14px Arial";
            ctx.textAlign = "center";
            ctx.fillText("LOKASI SFO", startX + sfoWidth / 2, roadY + roadHeight / 2 + 5);

            // Draw scale
            ctx.fillStyle = "#000";
            ctx.font = "12px Arial";
            ctx.textAlign = "center";
            
            // Draw scale markers and labels
            for (let i = 0; i <= 10; i++) {
                const x = roadStartX + (i * (roadWidth / 10));
                const staValue = i * 100;
                
                // Draw marker
                ctx.beginPath();
                ctx.moveTo(x, roadY + roadHeight + 5);
                ctx.lineTo(x, roadY + roadHeight + 15);
                ctx.strokeStyle = "#000";
                ctx.lineWidth = 1;
                ctx.stroke();
                
                // Draw label
                ctx.fillText(staValue.toString(), x, roadY + roadHeight + 30);
            }

            // Draw start and end labels
            ctx.fillText("0", roadStartX, roadY + roadHeight + 30);
            ctx.fillText("1000", roadStartX + roadWidth, roadY + roadHeight + 30);

            // Draw scale title
            ctx.font = "bold 14px Arial";
            ctx.fillText("STA SCALE (meter)", canvas.width / 2, roadY + roadHeight + 50);

            // Draw legend
            const legendY = roadY + roadHeight + 80;
            
            // SFO Legend
            ctx.fillStyle = "#007bff";
            ctx.fillRect(roadStartX, legendY, 20, 20);
            ctx.strokeStyle = "#0056b3";
            ctx.strokeRect(roadStartX, legendY, 20, 20);
            ctx.fillStyle = "#000";
            ctx.font = "12px Arial";
            ctx.textAlign = "left";
            ctx.fillText(": Area SFO", roadStartX + 30, legendY + 15);

            // Road Legend
            ctx.fillStyle = "#6c757d";
            ctx.fillRect(roadStartX + 150, legendY, 20, 20);
            ctx.fillStyle = "#000";
            ctx.fillText(": Jalan", roadStartX + 180, legendY + 15);
        });
    </script>
@endsection