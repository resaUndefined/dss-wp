<?php
 
namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class RiwayatExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $riwayat_penyakit = DB::table('riwayat_penyakit')->select('id','penyakit', 'kasus')->get();

        return $riwayat_penyakit;
    }
}