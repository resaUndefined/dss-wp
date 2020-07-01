<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class NilaiAlternatif extends Model
{
    protected $table = 'nilai_alternatif';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'periode',
        'waktu',
    ];

    public function penilaian()
    {
        return $this->hasMany('App\Model\Penilaian');
    }
}
