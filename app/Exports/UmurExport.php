<?php
 
namespace App\Exports;
 
use App\Model\DataMining;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class UmurExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $gender = DB::raw("(CASE WHEN gender='1' THEN 'laki-laki' ELSE 'perempuan' END) as gender");
        $datamining = DB::table('datamining')->select('id',$gender, 'umur')->get();

        return $datamining;
    }
}