<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RiwayatPenyakit extends Model
{
    protected $table = 'riwayat_penyakit';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'penyakit',
        'kasus',
    ];
}
