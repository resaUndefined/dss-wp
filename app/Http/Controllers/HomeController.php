<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Kriteria;
use App\Model\Alternatif;
use App\Model\NilaiAlternatif;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        $laki = 0;
        $perempuan = 0;
        
        foreach ($alternatif as $key => $value) {
            if ($value->gender == 1) {
                $laki+=1;
            } else {
                $perempuan+=1;
            }
        }

        $nilaiAlternatif = NilaiAlternatif::all();

        return view('home', [
            'kriteria' => $kriteria,
            'laki' => $laki,
            'perempuan' => $perempuan,
            'nilaiAlternatif' => $nilaiAlternatif
        ]);
    }
}
