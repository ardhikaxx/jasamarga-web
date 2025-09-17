<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';
    protected $fillable = ['jalur', 'lajur', 'keterangan'];

    public function aktivitasSfo()
    {
        return $this->hasMany(SfoActivity::class, 'location_id');
    }
}