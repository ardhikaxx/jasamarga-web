<?php

namespace App\Exports;

use App\Models\SfoActivity;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Collection;

class SfoExport implements FromCollection, WithHeadings, WithTitle, WithEvents, WithDrawings
{
    protected $projectId;
    protected $year;
    protected $project;

    public function __construct($projectId = null, $year = null)
    {
        $this->projectId = $projectId;
        $this->year = $year;
        
        if ($projectId) {
            $this->project = Project::find($projectId);
        }
    }

    public function collection()
    {
        $query = SfoActivity::with(['projek', 'lokasi', 'jenisPekerjaan'])
            ->orderBy('tanggal_sfo', 'asc');
            
        if ($this->projectId) {
            $query->where('project_id', $this->projectId);
        }
        
        if ($this->year) {
            $query->whereYear('tanggal_sfo', $this->year);
        }
        
        $activities = $query->get();
        
        // Jika tidak ada data
        if ($activities->isEmpty()) {
            return new Collection([
                ['Tidak ada data yang ditemukan untuk kriteria yang dipilih']
            ]);
        }
        
        $data = [];
        $counter = 1;
        $totalLuas = 0;
        
        foreach ($activities as $activity) {
            $panjang = abs($activity->sta_akhir - $activity->sta_awal);
            
            $data[] = [
                $counter++,
                $activity->tanggal_sfo->format('Y-m-d'),
                $activity->tanggal_sfo->format('Y-m-d'),
                $activity->sta_awal,
                $activity->sta_akhir,
                $activity->lokasi->jalur,
                $activity->lokasi->lajur,
                $panjang,
                $activity->lebar,
                $activity->tebal,
                $activity->luas,
                $activity->jenisPekerjaan->nama_pekerjaan
            ];
            
            $totalLuas += $activity->luas;
        }
        
        // Add total row
        if (!empty($data)) {
            $data[] = [
                '',
                '',
                '',
                'Total Luas Scraping',
                '',
                '',
                '',
                '',
                '',
                '',
                $totalLuas,
                ''
            ];
        }
        
        return new Collection($data);
    }

    public function headings(): array
    {
        $title = 'LAPORAN DATA SFO';
        
        if ($this->project) {
            $title = 'PADA RUAS JALAN TOL ' . strtoupper($this->project->lokasi) . ' TAHUN ' . $this->project->tahun_projek;
        } elseif ($this->year) {
            $title = 'LAPORAN DATA SFO TAHUN ' . $this->year;
        }
        
        return [
            ['PEKERJAAN PEMELIHARAAN PERIODIK'],
            ['SCRAPPING, FILLING, DAN OVERLAY (SFO)'],
            [$title],
            [''],
            [''],
            [''],
            [''],
            [
                'No.',
                'Tanggal',
                'Tanggal Pelaksanaan Real',
                'Lokasi (STA/KM)',
                '',
                'Posisi',
                '',
                'Panjang',
                'Lebar',
                'tebal',
                'Luas',
                'Keterangan'
            ],
            [
                '',
                '',
                '',
                'Dari',
                'Sampai',
                'Jalur',
                'Lajur',
                '(m)',
                'Rata2 (m)',
                '',
                '(m2)',
                ''
            ],
            [
                '(a)',
                '(b)',
                '',
                '(c)',
                '(d)',
                '(e)',
                '(f)',
                '(g)=(c)-(d)',
                '(h)',
                '',
                '(i)=(g)x(h)',
                '(j)'
            ]
        ];
    }

    public function title(): string
    {
        return 'Monitoring Berdasar Tgl MC';
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo Perusahaan');
        $drawing->setPath(public_path('images/9700334a6a74713fc8b77fdf69662bdc353cc38d.png'));
        $drawing->setHeight(70);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Set column widths
                $event->sheet->getColumnDimension('A')->setWidth(8);
                $event->sheet->getColumnDimension('B')->setWidth(15);
                $event->sheet->getColumnDimension('C')->setWidth(20);
                $event->sheet->getColumnDimension('D')->setWidth(10);
                $event->sheet->getColumnDimension('E')->setWidth(10);
                $event->sheet->getColumnDimension('F')->setWidth(25);
                $event->sheet->getColumnDimension('G')->setWidth(25);
                $event->sheet->getColumnDimension('H')->setWidth(12);
                $event->sheet->getColumnDimension('I')->setWidth(12);
                $event->sheet->getColumnDimension('J')->setWidth(10);
                $event->sheet->getColumnDimension('K')->setWidth(15);
                $event->sheet->getColumnDimension('L')->setWidth(30);
                
                // Merge cells for headers
                $event->sheet->mergeCells('A1:L1');
                $event->sheet->mergeCells('A2:L2');
                $event->sheet->mergeCells('A3:L3');
                
                // Style main headers
                $event->sheet->getStyle('A1:L3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ]
                ]);
                
                // Check if there's no data
                $lastRow = $event->sheet->getHighestRow();
                if ($lastRow == 1 && $event->sheet->getCell('A1')->getValue() == 'Tidak ada data yang ditemukan untuk kriteria yang dipilih') {
                    $event->sheet->mergeCells('A1:L1');
                    $event->sheet->getStyle('A1')->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'size' => 14,
                            'color' => ['argb' => 'FFFF0000']
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => 'FFFFFF00'
                            ]
                        ]
                    ]);
                    return;
                }
                
                // Style column headers
                $event->sheet->getStyle('A8:L10')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'FFE0E0E0'
                        ]
                    ]
                ]);
                
                // Merge header cells
                $event->sheet->mergeCells('D8:E8');
                $event->sheet->mergeCells('F8:G8');
                $event->sheet->mergeCells('A8:A10');
                $event->sheet->mergeCells('B8:B10');
                $event->sheet->mergeCells('C8:C10');
                $event->sheet->mergeCells('H8:H10');
                $event->sheet->mergeCells('I8:I10');
                $event->sheet->mergeCells('J8:J10');
                $event->sheet->mergeCells('K8:K10');
                $event->sheet->mergeCells('L8:L10');
                
                // Apply borders to data cells
                $dataRange = 'A8:L' . $lastRow;
                
                $event->sheet->getStyle($dataRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ]
                ]);
                
                // Format numbers
                $event->sheet->getStyle('H11:H' . $lastRow)
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    
                $event->sheet->getStyle('I11:I' . $lastRow)
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    
                $event->sheet->getStyle('K11:K' . $lastRow)
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                
                // Center align some columns
                $event->sheet->getStyle('A11:A' . $lastRow)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    
                $event->sheet->getStyle('F11:G' . $lastRow)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                // Highlight total row
                if ($lastRow > 10) {
                    $event->sheet->getStyle('A' . $lastRow . ':L' . $lastRow)->applyFromArray([
                        'font' => [
                            'bold' => true
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => 'FFFFFF00'
                            ]
                        ]
                    ]);
                    
                    // Merge cells in total row
                    $event->sheet->mergeCells('A' . $lastRow . ':J' . $lastRow);
                    $event->sheet->getStyle('A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                }
            },
        ];
    }
}