<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\DataMining;
use App\Model\RiwayatPenyakit;
use DB;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UmurExport;
use App\Exports\RiwayatExport;


class DataMiningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $gender = DB::raw("(CASE WHEN gender='1' THEN 'laki-laki' ELSE 'perempuan' END) as gender");
        $datamining = DB::table('datamining')->select('id','umur',$gender)->paginate(10);
        $riwayat = RiwayatPenyakit::paginate(5);

        return view('datamining.index', [
                'riwayat' => $riwayat,
                'datamining' => $datamining
        ]);
    }


    public function export_usia($type)
    {
        return Excel::download(new UmurExport, 'dataset_umur.'.$type);
    }


    public function export_riwayat($type)
    {
        return Excel::download(new RiwayatExport, 'dataset_riwayat_penyakit.'.$type);
    }

}
