<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Nonaktifkan pemeriksaan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate tabel
        DB::table('sfo_activities')->truncate();
        DB::table('projects')->truncate();
        DB::table('work_types')->truncate();
        DB::table('locations')->truncate();
        
        // Aktifkan kembali pemeriksaan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed data master
        $this->call([
            ProjectSeeder::class,
            WorkTypeSeeder::class,
            LocationSeeder::class,
            SfoActivitySeeder::class,
        ]);
    }
}

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'nama_projek' => 'PEKERJAAN PEMELIHARAAN PERIODIK SCRAPPING, FILLING, DAN OVERLAY (SFO) PADA RUAS JALAN TOL SURABAYA - GEMPOL TAHUN 2023',
                'lokasi' => 'Ruas Jalan Tol Surabaya - Gempol',
                'tahun_projek' => 2023,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_projek' => 'PEKERJAAN PEMELIHARAAN PERIODIK SCRAPPING, FILLING, DAN OVERLAY (SFO) PADA RUAS JALAN TOL SURABAYA - GEMPOL TAHUN 2024',
                'lokasi' => 'Ruas Jalan Tol Surabaya - Gempol',
                'tahun_projek' => 2024,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_projek' => 'PEKERJAAN PEMELIHARAAN PERIODIK SCRAPPING, FILLING, DAN OVERLAY (SFO) PADA RUAS JALAN TOL SURABAYA - GEMPOL TAHUN 2025',
                'lokasi' => 'Ruas Jalan Tol Surabaya - Gempol',
                'tahun_projek' => 2025,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

class WorkTypeSeeder extends Seeder
{
    public function run(): void
    {
        $workTypes = [
            ['nama_pekerjaan' => 'Scraping Filling AC WC', 'deskripsi' => 'Scraping dan Filling AC WC', 'created_at' => now(), 'updated_at' => now()],
            ['nama_pekerjaan' => 'Scraping Filling AC BC', 'deskripsi' => 'Scraping dan Filling AC BC', 'created_at' => now(), 'updated_at' => now()],
            ['nama_pekerjaan' => 'Scraping Filling AC BC LAYER 1', 'deskripsi' => 'Scraping dan Filling AC BC Layer 1', 'created_at' => now(), 'updated_at' => now()],
            ['nama_pekerjaan' => 'Scraping Filling AC BC LAYER 2', 'deskripsi' => 'Scraping dan Filling AC BC Layer 2', 'created_at' => now(), 'updated_at' => now()],
            ['nama_pekerjaan' => 'Rising AC BC', 'deskripsi' => 'Rising AC BC', 'created_at' => now(), 'updated_at' => now()],
            ['nama_pekerjaan' => 'Overlay AC WC', 'deskripsi' => 'Overlay AC WC', 'created_at' => now(), 'updated_at' => now()],
            ['nama_pekerjaan' => 'Overlay AC WC Kuncian Awal', 'deskripsi' => 'Overlay AC WC Kuncian Awal', 'created_at' => now(), 'updated_at' => now()],
            ['nama_pekerjaan' => 'Overlay AC WC Kuncian Akhir', 'deskripsi' => 'Overlay AC WC Kuncian Akhir', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('work_types')->insert($workTypes);
    }
}

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['jalur' => 'A', 'lajur' => '3', 'keterangan' => 'Jalur A Lajur 3', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'A', 'lajur' => '2', 'keterangan' => 'Jalur A Lajur 2', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'A', 'lajur' => '2&3', 'keterangan' => 'Jalur A Lajur 2 dan 3', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'B', 'lajur' => '3', 'keterangan' => 'Jalur B Lajur 3', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'B', 'lajur' => '2', 'keterangan' => 'Jalur B Lajur 2', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'B', 'lajur' => '1', 'keterangan' => 'Jalur B Lajur 1', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'B', 'lajur' => '0&1', 'keterangan' => 'Jalur B Lajur 0 dan 1', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'B', 'lajur' => '0', 'keterangan' => 'Jalur B Lajur 0', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'OFF RAMP SATELIT B', 'lajur' => 'KIRI', 'keterangan' => 'Off Ramp Satelit B Sisi Kiri', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'ON RAMP B.URIP', 'lajur' => 'KANAN', 'keterangan' => 'On Ramp B. Urip Sisi Kanan', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'ON RAMP B.URIP', 'lajur' => 'KIRI', 'keterangan' => 'On Ramp B. Urip Sisi Kiri', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'TRANSISI OFFRAMP SATELIT B', 'lajur' => '1', 'keterangan' => 'Transisi Off Ramp Satelit B', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'AKSES OFF RAMP PSR TURI/B', 'lajur' => '0', 'keterangan' => 'Akses Off Ramp PSR Turi/B', 'created_at' => now(), 'updated_at' => now()],
            ['jalur' => 'LOOP OFF RAMP PSR TURI/B', 'lajur' => 'KANAN', 'keterangan' => 'Loop Off Ramp PSR Turi/B Kanan', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('locations')->insert($locations);
    }
}

class SfoActivitySeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID projects
        $projects = [];
        $projectRecords = DB::table('projects')->get();
        foreach ($projectRecords as $project) {
            $projects[$project->tahun_projek] = $project->id;
        }
        
        // Ambil ID work types
        $workTypes = [];
        $workTypeRecords = DB::table('work_types')->get();
        foreach ($workTypeRecords as $wt) {
            $workTypes[$wt->nama_pekerjaan] = $wt->id;
        }
        
        // Ambil ID locations
        $locations = [];
        $locationRecords = DB::table('locations')->get();
        foreach ($locationRecords as $loc) {
            $key = $loc->jalur . '|' . $loc->lajur;
            $locations[$key] = $loc->id;
        }
        
        $sfoActivities = [];
        
        // Data untuk tahun 2023 (Januari - Desember)
        for ($month = 1; $month <= 12; $month++) {
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, 2023);
            $activitiesCount = rand(3, 8); // 3-8 aktivitas per bulan
            
            for ($i = 0; $i < $activitiesCount; $i++) {
                $day = rand(1, $daysInMonth);
                $panjang = rand(50, 200); // 50-200 meter
                $lebar = rand(30, 50) / 10; // 3.0-5.0 meter
                $tebal = [0.04, 0.05, 0.06, 0.07, 0.08][rand(0, 4)]; // Random tebal
                $luas = $panjang * $lebar;
                
                $workTypeKeys = array_keys($workTypes);
                $workTypeKey = $workTypeKeys[rand(0, count($workTypeKeys) - 1)];
                
                $locationKeys = array_keys($locations);
                $locationKey = $locationKeys[rand(0, count($locationKeys) - 1)];
                
                $sfoActivities[] = [
                    'project_id' => $projects[2023],
                    'tanggal_sfo' => Carbon::create(2023, $month, $day),
                    'sta_awal' => rand(750000, 770000),
                    'sta_akhir' => rand(750000, 770000),
                    'location_id' => $locations[$locationKey],
                    'panjang' => $panjang,
                    'lebar' => $lebar,
                    'tebal' => $tebal,
                    'luas' => $luas,
                    'work_type_id' => $workTypes[$workTypeKey],
                    'status' => ['Unprocessed', 'Process', 'Done'][rand(0, 2)],
                    'notes' => 'Aktivitas SFO bulan ' . $month . ' tahun 2023',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        
        // Data untuk tahun 2024 (Januari - Desember) - lebih banyak data
        for ($month = 1; $month <= 12; $month++) {
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, 2024);
            $activitiesCount = rand(5, 12); // 5-12 aktivitas per bulan
            
            for ($i = 0; $i < $activitiesCount; $i++) {
                $day = rand(1, $daysInMonth);
                $panjang = rand(60, 250); // 60-250 meter
                $lebar = rand(35, 60) / 10; // 3.5-6.0 meter
                $tebal = [0.04, 0.05, 0.06, 0.07, 0.08, 0.09][rand(0, 5)]; // Random tebal
                $luas = $panjang * $lebar;
                
                $workTypeKeys = array_keys($workTypes);
                $workTypeKey = $workTypeKeys[rand(0, count($workTypeKeys) - 1)];
                
                $locationKeys = array_keys($locations);
                $locationKey = $locationKeys[rand(0, count($locationKeys) - 1)];
                
                $sfoActivities[] = [
                    'project_id' => $projects[2024],
                    'tanggal_sfo' => Carbon::create(2024, $month, $day),
                    'sta_awal' => rand(750000, 770000),
                    'sta_akhir' => rand(750000, 770000),
                    'location_id' => $locations[$locationKey],
                    'panjang' => $panjang,
                    'lebar' => $lebar,
                    'tebal' => $tebal,
                    'luas' => $luas,
                    'work_type_id' => $workTypes[$workTypeKey],
                    'status' => ['Unprocessed', 'Process', 'Done'][rand(0, 2)],
                    'notes' => 'Aktivitas SFO bulan ' . $month . ' tahun 2024',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        
        // Data untuk tahun 2025 (Januari - September) - data untuk tahun berjalan
        for ($month = 1; $month <= 9; $month++) {
            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, 2025);
            $activitiesCount = rand(4, 10); // 4-10 aktivitas per bulan
            
            for ($i = 0; $i < $activitiesCount; $i++) {
                $day = rand(1, $daysInMonth);
                $panjang = rand(70, 300); // 70-300 meter
                $lebar = rand(40, 70) / 10; // 4.0-7.0 meter
                $tebal = [0.05, 0.06, 0.07, 0.08, 0.09, 0.10][rand(0, 5)]; // Random tebal
                $luas = $panjang * $lebar;
                
                $workTypeKeys = array_keys($workTypes);
                $workTypeKey = $workTypeKeys[rand(0, count($workTypeKeys) - 1)];
                
                $locationKeys = array_keys($locations);
                $locationKey = $locationKeys[rand(0, count($locationKeys) - 1)];
                
                $sfoActivities[] = [
                    'project_id' => $projects[2025],
                    'tanggal_sfo' => Carbon::create(2025, $month, $day),
                    'sta_awal' => rand(750000, 770000),
                    'sta_akhir' => rand(750000, 770000),
                    'location_id' => $locations[$locationKey],
                    'panjang' => $panjang,
                    'lebar' => $lebar,
                    'tebal' => $tebal,
                    'luas' => $luas,
                    'work_type_id' => $workTypes[$workTypeKey],
                    'status' => $month <= 9 ? ['Unprocessed', 'Process', 'Done'][rand(0, 2)] : 'Unprocessed', // Untuk bulan depan status Unprocessed
                    'notes' => 'Aktivitas SFO bulan ' . $month . ' tahun 2025',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        
        // Data khusus untuk contoh asli (tetap dipertahankan)
        $sfoActivities = array_merge($sfoActivities, [
            // Data 1: Sesuai baris 13 di Excel
            [
                'project_id' => $projects[2024],
                'tanggal_sfo' => Carbon::create(2024, 3, 22),
                'sta_awal' => 759329,
                'sta_akhir' => 759494,
                'location_id' => $locations['A|3'],
                'panjang' => 165.00,
                'lebar' => 3.60,
                'tebal' => 0.06,
                'luas' => 594.00,
                'work_type_id' => $workTypes['Scraping Filling AC WC'],
                'status' => 'Done',
                'notes' => 'Scraping Filling AC WC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Data 2: Sesuai baris 15 di Excel
            [
                'project_id' => $projects[2024],
                'tanggal_sfo' => Carbon::create(2024, 3, 23),
                'sta_awal' => 759329,
                'sta_akhir' => 759494,
                'location_id' => $locations['A|2'],
                'panjang' => 165.00,
                'lebar' => 3.60,
                'tebal' => 0.06,
                'luas' => 594.00,
                'work_type_id' => $workTypes['Scraping Filling AC WC'],
                'status' => 'Done',
                'notes' => 'Scraping Filling AC WC',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Data 10: Sesuai baris 267-269 di Excel (rising)
            [
                'project_id' => $projects[2024],
                'tanggal_sfo' => Carbon::create(2024, 6, 15),
                'sta_awal' => 98,
                'sta_akhir' => 238,
                'location_id' => $locations['A|3'],
                'panjang' => 140.00,
                'lebar' => 4.70,
                'tebal' => 0.09,
                'luas' => 658.00,
                'work_type_id' => $workTypes['Rising AC BC'],
                'status' => 'Done',
                'notes' => 'Rising AC BC Badan Jalan',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Chunk insert untuk menghindari memory limit
        foreach (array_chunk($sfoActivities, 100) as $chunk) {
            DB::table('sfo_activities')->insert($chunk);
        }
    }
}