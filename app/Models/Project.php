<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = ['nama_projek', 'lokasi', 'tahun_projek'];

    public function aktivitasSfo()
    {
        return $this->hasMany(SfoActivity::class, 'project_id');
    }
}