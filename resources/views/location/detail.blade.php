@extends('layouts.app')

@section('title', 'Location SFO')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body p-4">
            <h3 class="mb-4 text-center text-primary fw-bold">CHECK LOCATION SFO</h3>

            <div class="d-flex justify-content-center align-items-center mb-5">
                <canvas id="sfoCanvas" width="900" height="400"></canvas>
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
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const canvas = document.getElementById("sfoCanvas");
        const ctx = canvas.getContext("2d");

        const urlParams = new URLSearchParams(window.location.search);
        const selectedJalur = parseInt(urlParams.get("jalur")) || 1;

        // Dummy data (nanti diganti dari database)
        const dataSFO = [
            { km_awal: 0, km_akhir: 1, warna: "blue", tahun: "2022" },
            { km_awal: 1, km_akhir: 2, warna: "green", tahun: "2023" },
            { km_awal: 2, km_akhir: 3, warna: "blue", tahun: "2024" },
            { km_awal: 3, km_akhir: 4, warna: "blue", tahun: "2025" },
        ];

        // posisi Y untuk tiap jalur (lebih renggang)
        const jalurY = {1: 100, 2: 230, 3: 360}; 
        const kmStep = 200; // lebar per KM

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
                ctx.fillText(item.tahun, startX + width/2 - 15, y + 65);

                // panah (semua jalur ada panah)
                drawArrow(startX + width/2, y);
            });

            // KM label di atas jalur
            ctx.fillStyle = "#000";
            ctx.font = "14px Arial";
            for(let km=0; km<=4; km++){
                ctx.fillText("KM " + km, 50 + km*kmStep, y - 15);
            }
        }

        // gambar semua jalur
        drawTrack(1);
        drawTrack(2);
        drawTrack(3);
    });
</script>
@endsection
