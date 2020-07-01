<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode',
        'nama',
        'jenis',
        'bobot',
        'kluster',
    ];

    public function subKriteria()
    {
        return $this->hasMany('App\Model\SubKriteria');
    }
}
