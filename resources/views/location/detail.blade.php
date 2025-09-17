@extends('layouts.app')

@section('title', 'Location SFO')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-4">
                <h3 class="mb-4 text-center text-primary fw-bold">LOCATION SFO</h3>

                <div class="d-flex justify-content-center align-items-center mb-5">
                    <div class="canvas-wrapper">
                        <canvas id="sfoCanvas" width="900" height="400"></canvas>
                    </div>
                </div>

                <div class="d-flex justify-content-start align-items-center">
                    <div class="keterangan-sfo w-100">
                        <h4 class="text-primary mb-3">Keterangan Data SFO</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold text-secondary">Lokasi SFO:</span>
                                    <span id="lokasi-sfo">{{ $sfo->lokasi_awal }} - {{ $sfo->lokasi_akhir }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold text-secondary">Posisi Jalur:</span>
                                    <span id="posisi-jalur">{{ $sfo->posisi_awal }} - {{ $sfo->posisi_akhir }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="info-item">
                                    <span class="fw-bold text-secondary">Panjang:</span>
                                    <span id="panjang">{{ number_format($sfo->panjang, 2) }} m</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-item">
                                    <span class="fw-bold text-secondary">Lebar:</span>
                                    <span id="lebar">{{ number_format($sfo->lebar, 2) }} m</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-item">
                                    <span class="fw-bold text-secondary">Tebal:</span>
                                    <span id="tebal">{{ number_format($sfo->tebal, 2) }} m</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="info-item">
                                    <span class="fw-bold text-secondary">Luas:</span>
                                    <span id="luas">{{ number_format($sfo->luas, 2) }} m²</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold text-secondary">Tanggal SFO:</span>
                                    <span
                                        id="tanggal-sfo">{{ \Carbon\Carbon::parse($sfo->tanggal_sfo)->format('d-m-Y') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="fw-bold text-secondary">Jalur SFO:</span>
                                    <span id="jalur-sfo">{{ $sfo->jalur_sfo }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-item">
                                    <span class="fw-bold text-secondary">Keterangan:</span>
                                    <span id="keterangan">{{ $sfo->keterangan ?? 'Tidak ada keterangan' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('check-location') }}" class="btn btn-primary px-4">
                        Kembali <i class="bi bi-check-circle-fill fs-5 ms-2"></i>
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
            -webkit-overflow-scrolling: touch;
        }

        @media (min-width: 992px) {
            .canvas-wrapper {
                max-width: 900px;
                overflow-x: hidden;
            }
        }

        @media (max-width: 991px) and (min-width: 768px) {
            .canvas-wrapper {
                max-width: 700px;
            }
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
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const canvas = document.getElementById("sfoCanvas");
            const ctx = canvas.getContext("2d");

            // Data dari database
            const jalurSFO = "{{ $sfo->jalur_sfo }}";
            const posisiAwal = "{{ $sfo->posisi_awal }}";
            const posisiAkhir = "{{ $sfo->posisi_akhir }}";
            const tahunSFO = "{{ \Carbon\Carbon::parse($sfo->tanggal_sfo)->format('Y') }}";

            // Mapping jalur ke angka
            let selectedJalur = 1;
            const jalurMapping = {
                'Jalur Tol Bogor': 1,
                'Jalur Tol Jakarta': 2,
                'Jalur Tol Cikampek': 3,
                // Tambahkan mapping lainnya sesuai data yang ada
            };

            // Cari jalur yang cocok (partial match)
            for (const [key, value] of Object.entries(jalurMapping)) {
                if (jalurSFO.includes(key)) {
                    selectedJalur = value;
                    break;
                }
            }

            // Ekstrak angka KM dari string
            function parseKM(kmString) {
                if (!kmString) return 0;

                // Coba format "KM XX+XXX"
                let match = kmString.match(/KM\s*(\d+)\+(\d+)/i);
                if (match) {
                    const km = parseInt(match[1]);
                    const meter = parseInt(match[2]);
                    return km + (meter / 1000);
                }

                // Coba format "KM XX"
                match = kmString.match(/KM\s*(\d+)/i);
                if (match) {
                    return parseInt(match[1]);
                }

                // Coba format angka saja
                match = kmString.match(/(\d+)/);
                if (match) {
                    return parseInt(match[1]);
                }

                return 0;
            }

            const kmAwal = parseKM(posisiAwal);
            const kmAkhir = parseKM(posisiAkhir) || kmAwal + 1; // Default jika tidak ada akhir

            // Data untuk grafik
            const dataSFO = [{
                km_awal: kmAwal,
                km_akhir: kmAkhir,
                warna: "blue",
                tahun: tahunSFO
            }];

            // posisi Y untuk tiap jalur
            const jalurY = {
                1: 100,
                2: 230,
                3: 360
            };

            // Tentukan kmStep berdasarkan rentang KM
            const maxKM = Math.max(kmAkhir, 4); // Minimal 4 KM untuk tampilan
            const kmStep = 800 / maxKM; // Lebar canvas 800px

            function drawArrow(x, y) {
                ctx.beginPath();
                ctx.moveTo(x, y);
                ctx.lineTo(x, y - 25);
                ctx.lineTo(x - 5, y - 20);
                ctx.moveTo(x, y - 25);
                ctx.lineTo(x + 5, y - 20);
                ctx.strokeStyle = "#000";
                ctx.stroke();
            }

            function drawTrack(jalur) {
                let y = jalurY[jalur];

                // garis dasar jalur
                ctx.fillStyle = (jalur == selectedJalur) ? "#e0e0e0" : "#f5f5f5";
                ctx.fillRect(50, y, 800, 40);

                // blok-blok data
                dataSFO.forEach(item => {
                    let startX = 50 + item.km_awal * kmStep;
                    let width = (item.km_akhir - item.km_awal) * kmStep;

                    ctx.fillStyle = (jalur == selectedJalur) ? item.warna : "#cfcfcf";
                    ctx.fillRect(startX, y, width, 40);

                    // tahun label
                    ctx.fillStyle = "#000";
                    ctx.font = "14px Arial";
                    ctx.fillText(item.tahun, startX + width / 2 - 15, y + 65);

                    // panah
                    if (jalur == selectedJalur) {
                        drawArrow(startX + width / 2, y);
                    }
                });

                // KM label di atas jalur
                ctx.fillStyle = "#000";
                ctx.font = "14px Arial";
                for (let km = 0; km <= maxKM; km++) {
                    ctx.fillText("KM " + km, 50 + km * kmStep, y - 15);
                }
            }

            // gambar semua jalur
            drawTrack(1);
            drawTrack(2);
            drawTrack(3);
        });
    </script>
@endsection
