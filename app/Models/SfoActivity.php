<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SfoActivity extends Model
{
    use HasFactory;

    protected $table = 'sfo_activities';
    protected $fillable = [
        'project_id',
        'tanggal_sfo',
        'sta_awal',
        'sta_akhir',
        'location_id',
        'panjang',
        'lebar',
        'tebal',
        'luas',
        'work_type_id',
        'status',
        'notes'
    ];

    protected $casts = [
        'tanggal_sfo' => 'date',
        'panjang' => 'decimal:2',
        'lebar' => 'decimal:2',
        'tebal' => 'decimal:2',
        'luas' => 'decimal:2',
        'status' => 'string',
    ];

    public function projek()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function jenisPekerjaan()
    {
        return $this->belongsTo(WorkType::class, 'work_type_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}