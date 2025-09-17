<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkType extends Model
{
    use HasFactory;

    protected $table = 'work_types';
    protected $fillable = ['nama_pekerjaan', 'deskripsi'];

    public function aktivitasSfo()
    {
        return $this->hasMany(SfoActivity::class, 'work_type_id');
    }
}