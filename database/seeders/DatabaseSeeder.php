<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\WorkType;
use App\Models\Location;
use App\Models\SfoActivity;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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
        Project::create([
            'nama_projek' => 'PEKERJAAN PEMELIHARAAN PERIODIK SCRAPPING, FILLING, DAN OVERLAY (SFO) PADA RUAS JALAN TOL SURABAYA - GEMPOL TAHUN 2024',
            'lokasi' => 'Ruas Jalan Tol Surabaya - Gempol',
            'tahun_projek' => 2024
        ]);
    }
}

class WorkTypeSeeder extends Seeder
{
    public function run(): void
    {
        $workTypes = [
            ['nama_pekerjaan' => 'Scraping Filling AC WC', 'deskripsi' => 'Scraping dan Filling AC WC'],
            ['nama_pekerjaan' => 'Scraping Filling AC BC', 'deskripsi' => 'Scraping dan Filling AC BC'],
            ['nama_pekerjaan' => 'Scraping Filling AC BC LAYER 1', 'deskripsi' => 'Scraping dan Filling AC BC Layer 1'],
            ['nama_pekerjaan' => 'Scraping Filling AC BC LAYER 2', 'deskripsi' => 'Scraping dan Filling AC BC Layer 2'],
            ['nama_pekerjaan' => 'Rising AC BC', 'deskripsi' => 'Rising AC BC'],
            ['nama_pekerjaan' => 'Overlay AC WC', 'deskripsi' => 'Overlay AC WC'],
            ['nama_pekerjaan' => 'Overlay AC WC Kuncian Awal', 'deskripsi' => 'Overlay AC WC Kuncian Awal'],
            ['nama_pekerjaan' => 'Overlay AC WC Kuncian Akhir', 'deskripsi' => 'Overlay AC WC Kuncian Akhir'],
        ];

        foreach ($workTypes as $workType) {
            WorkType::create($workType);
        }
    }
}

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['jalur' => 'A', 'lajur' => '3', 'keterangan' => 'Jalur A Lajur 3'],
            ['jalur' => 'A', 'lajur' => '2', 'keterangan' => 'Jalur A Lajur 2'],
            ['jalur' => 'A', 'lajur' => '2&3', 'keterangan' => 'Jalur A Lajur 2 dan 3'],
            ['jalur' => 'B', 'lajur' => '3', 'keterangan' => 'Jalur B Lajur 3'],
            ['jalur' => 'B', 'lajur' => '2', 'keterangan' => 'Jalur B Lajur 2'],
            ['jalur' => 'B', 'lajur' => '1', 'keterangan' => 'Jalur B Lajur 1'],
            ['jalur' => 'B', 'lajur' => '0&1', 'keterangan' => 'Jalur B Lajur 0 dan 1'],
            ['jalur' => 'B', 'lajur' => '0', 'keterangan' => 'Jalur B Lajur 0'],
            ['jalur' => 'OFF RAMP SATELIT B', 'lajur' => 'KIRI', 'keterangan' => 'Off Ramp Satelit B Sisi Kiri'],
            ['jalur' => 'ON RAMP B.URIP', 'lajur' => 'KANAN', 'keterangan' => 'On Ramp B. Urip Sisi Kanan'],
            ['jalur' => 'ON RAMP B.URIP', 'lajur' => 'KIRI', 'keterangan' => 'On Ramp B. Urip Sisi Kiri'], // TAMBAH INI
            ['jalur' => 'TRANSISI OFFRAMP SATELIT B', 'lajur' => '1', 'keterangan' => 'Transisi Off Ramp Satelit B'],
            ['jalur' => 'AKSES OFF RAMP PSR TURI/B', 'lajur' => '0', 'keterangan' => 'Akses Off Ramp PSR Turi/B'],
            ['jalur' => 'LOOP OFF RAMP PSR TURI/B', 'lajur' => 'KANAN', 'keterangan' => 'Loop Off Ramp PSR Turi/B Kanan'],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}

class SfoActivitySeeder extends Seeder
{
    public function run(): void
    {
        $project = Project::first();
        $workTypes = WorkType::all();
        $locations = Location::all();

        // Data 1: Sesuai baris 13 di Excel
        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 3, 22),
            'sta_awal' => 759329,
            'sta_akhir' => 759494,
            'location_id' => $locations->where('jalur', 'A')->where('lajur', '3')->first()->id,
            'panjang' => 165.00,
            'lebar' => 3.60,
            'tebal' => 0.06,
            'luas' => 594.00,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Scraping Filling AC WC')->first()->id,
            'notes' => 'Scraping Filling AC WC'
        ]);

        // Data 2: Sesuai baris 15 di Excel
        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 3, 23),
            'sta_awal' => 759329,
            'sta_akhir' => 759494,
            'location_id' => $locations->where('jalur', 'A')->where('lajur', '2')->first()->id,
            'panjang' => 165.00,
            'lebar' => 3.60,
            'tebal' => 0.06,
            'luas' => 594.00,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Scraping Filling AC WC')->first()->id,
            'notes' => 'Scraping Filling AC WC'
        ]);

        // Data 3: Sesuai baris 17 di Excel
        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 3, 25),
            'sta_awal' => 762317,
            'sta_akhir' => 762472,
            'location_id' => $locations->where('jalur', 'A')->where('lajur', '3')->first()->id,
            'panjang' => 155.00,
            'lebar' => 3.80,
            'tebal' => 0.06,
            'luas' => 589.00,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Scraping Filling AC WC')->first()->id,
            'notes' => 'Scraping Filling AC WC'
        ]);

        // Data 4: Sesuai baris 19 di Excel
        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 3, 26),
            'sta_awal' => 762279,
            'sta_akhir' => 762434,
            'location_id' => $locations->where('jalur', 'A')->where('lajur', '2')->first()->id,
            'panjang' => 155.00,
            'lebar' => 3.80,
            'tebal' => 0.06,
            'luas' => 589.00,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Scraping Filling AC WC')->first()->id,
            'notes' => 'Scraping Filling AC WC'
        ]);

        // Data 5: Sesuai baris 21 di Excel (B arah berlawanan)
        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 3, 27),
            'sta_awal' => 759525,
            'sta_akhir' => 759360,
            'location_id' => $locations->where('jalur', 'B')->where('lajur', '3')->first()->id,
            'panjang' => 165.00,
            'lebar' => 3.60,
            'tebal' => 0.06,
            'luas' => 594.00,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Scraping Filling AC WC')->first()->id,
            'notes' => 'Scraping Filling AC WC'
        ]);

        // Data 6: Sesuai baris 25-26 di Excel (multiple sections)
        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 3, 29),
            'sta_awal' => 755319,
            'sta_akhir' => 755372,
            'location_id' => $locations->where('jalur', 'A')->where('lajur', '2&3')->first()->id,
            'panjang' => 53.00,
            'lebar' => 7.20,
            'tebal' => 0.06,
            'luas' => 381.60,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Scraping Filling AC WC')->first()->id,
            'notes' => 'Scraping Filling AC WC Section 1'
        ]);

        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 3, 29),
            'sta_awal' => 755394,
            'sta_akhir' => 755441,
            'location_id' => $locations->where('jalur', 'A')->where('lajur', '2&3')->first()->id,
            'panjang' => 47.00,
            'lebar' => 7.20,
            'tebal' => 0.06,
            'luas' => 338.40,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Scraping Filling AC WC')->first()->id,
            'notes' => 'Scraping Filling AC WC Section 2'
        ]);

        // Data 7: Sesuai baris 28-30 di Excel (mixed work types)
        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 3, 30),
            'sta_awal' => 755341,
            'sta_akhir' => 755320,
            'location_id' => $locations->where('jalur', 'B')->where('lajur', '0&1')->first()->id,
            'panjang' => 21.00,
            'lebar' => 6.60,
            'tebal' => 0.06,
            'luas' => 138.60,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Scraping Filling AC BC LAYER 1')->first()->id,
            'notes' => 'Scraping Filling AC BC LAYER 1'
        ]);

        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 3, 30),
            'sta_awal' => 755382,
            'sta_akhir' => 755312,
            'location_id' => $locations->where('jalur', 'B')->where('lajur', '0')->first()->id,
            'panjang' => 70.00,
            'lebar' => 3.00,
            'tebal' => 0.06,
            'luas' => 210.00,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Scraping Filling AC BC LAYER 2')->first()->id,
            'notes' => 'Scraping Filling AC BC LAYER 2'
        ]);

        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 3, 30),
            'sta_awal' => 755443,
            'sta_akhir' => 755312,
            'location_id' => $locations->where('jalur', 'B')->where('lajur', '1')->first()->id,
            'panjang' => 131.00,
            'lebar' => 3.60,
            'tebal' => 0.06,
            'luas' => 471.60,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Scraping Filling AC WC')->first()->id,
            'notes' => 'Scraping Filling AC WC'
        ]);

        // Data 8: Sesuai baris 95-97 di Excel (off ramp)
        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 5, 20),
            'sta_awal' => 0,
            'sta_akhir' => 74,
            'location_id' => $locations->where('jalur', 'OFF RAMP SATELIT B')->where('lajur', 'KIRI')->first()->id,
            'panjang' => 74.00,
            'lebar' => 4.45,
            'tebal' => 0.06,
            'luas' => 329.30,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Scraping Filling AC WC')->first()->id,
            'notes' => 'Scraping Filling AC WC Off Ramp'
        ]);

        // Data 9: Sesuai baris 120-122 di Excel (on ramp) - DIPERBAIKI
        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 5, 26),
            'sta_awal' => 200,
            'sta_akhir' => 275,
            'location_id' => $locations->where('jalur', 'ON RAMP B.URIP')->where('lajur', 'KIRI')->first()->id,
            'panjang' => 75.00,
            'lebar' => 3.60,
            'tebal' => 0.06,
            'luas' => 270.00,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Scraping Filling AC WC')->first()->id,
            'notes' => 'Scraping Filling AC WC On Ramp Section 1'
        ]);

        // Data 10: Sesuai baris 267-269 di Excel (rising)
        SfoActivity::create([
            'project_id' => $project->id,
            'tanggal_sfo' => Carbon::create(2024, 6, 15),
            'sta_awal' => 98,
            'sta_akhir' => 238,
            'location_id' => $locations->first()->id, // Default location
            'panjang' => 140.00,
            'lebar' => 4.70,
            'tebal' => 0.09,
            'luas' => 658.00,
            'work_type_id' => $workTypes->where('nama_pekerjaan', 'Rising AC BC')->first()->id,
            'notes' => 'Rising AC BC Badan Jalan'
        ]);
    }
}
