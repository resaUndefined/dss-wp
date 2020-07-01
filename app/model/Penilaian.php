<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'penilaian';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alternatif_id',
        'periode_id',
        'kriteria_id',
        'sub_kriteria_id',
    ];

    public function alternatif()
    {
        return $this->belongsTo('App\Model\Alternatif');
    }

    public function kriteria()
    {
        return $this->belongsTo('App\Model\Kriteria');
    }

    public function periode()
    {
        return $this->belongsTo('App\Model\NilaiAlternatif');
    }

    public function subKriteria()
    {
        return $this->belongsTo('App\Model\SubKriteria');
    }
}
