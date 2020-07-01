<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = 'alternatif';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'jabatan',
        'alamat',
        'ttl',
        'gender',
    ];

    public function penilaian()
    {
        return $this->hasMany('App\Model\Penilaian');
    }
}
