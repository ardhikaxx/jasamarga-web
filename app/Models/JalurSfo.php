<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JalurSfo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_jalur',
        'keterangan',
    ];

    /**
     * Get all of the sfos for the JalurSfo
     */
    public function sfos(): HasMany
    {
        return $this->hasMany(Sfo::class);
    }
}