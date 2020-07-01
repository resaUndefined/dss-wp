<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class DataMining extends Model
{
    protected $table = 'datamining';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'gender',
        'umur',
        'riwayat_penyakit',
    ];

}
