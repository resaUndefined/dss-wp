<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    protected $table = 'sub_kriteria';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kriteria_id',
        'keterangan',
        'bobot',
    ];

    public function penilaian()
    {
        return $this->hasMany('App\Model\Penilaian');
    }

    public function kriteria()
    {
        return $this->belongsTo('App\Model\Kriteria');
    }
}
