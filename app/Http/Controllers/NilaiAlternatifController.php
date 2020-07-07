<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\NilaiAlternatif;
use App\Model\Kriteria;
use App\Model\SubKriteria;
use App\Model\Alternatif;
use App\Model\Penilaian;
use DB;
use Validator;
use App\Charts\PenilaianChart;


class NilaiAlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $nilaiAlternatif = NilaiAlternatif::paginate(10);

        return view('nilai_alternatif.index', [
            'nilaiAlternatif' => $nilaiAlternatif
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        $dataSubKriteria = array();
        // $dataSubKriteria[] = new \stdClass();

        foreach ($kriteria as $key => $k) {
            $subKriteriaTmp = SubKriteria::where('kriteria_id',$k->id)->get();
            foreach ($subKriteriaTmp as $kunci => $sk) {
                if(!isset($dataSubKriteria[$key])) {
                    $dataSubKriteria[$key] = new \StdClass();
                }
                $dataSubKriteria[$key]->id = $k->id;
                $dataSubKriteria[$key]->kode = $k->kode;
                $dataSubKriteria[$key]->sub_id[$kunci] = $sk->id;
                $dataSubKriteria[$key]->kriteria[$kunci] = $k->nama;
                $dataSubKriteria[$key]->keterangan[$kunci] = $sk->keterangan;
            }
        }
        $alternatif = Alternatif::all();

        return view('nilai_alternatif.create', [
                'kriteria' => $kriteria,
                'dataSubKriteria' => $dataSubKriteria,
                'alternatif' => $alternatif
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                        'periode' => 'required|unique:nilai_alternatif,periode',
                        'tanggal' => 'required',
                    ],
                    [
                        'periode.required' => 'Periode wajib diisi',
                        'periode.unique' => 'Periode sudah digunakan',
                        'tanggal.required' => 'Tanggal wajib diisi',
                    ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $nilaiAlternatif = new NilaiAlternatif();
            preg_match_all('!\d+!', $request->tanggal, $tanggal);
            $nilaiAlternatif->periode = $request->periode;
            $nilaiAlternatif->waktu = $tanggal[0][2].'-'.$tanggal[0][0].'-'.$tanggal[0][1];
            $nilaiAlternatifSave = $nilaiAlternatif->save();

            if ($nilaiAlternatifSave) {
                $kriteria = Kriteria::select('kode')->get();
                foreach ($request->alternatif as $kunci => $al) {
                    foreach ($kriteria as $key => $k) {
                        $penilaian = new Penilaian();
                        $penilaian->alternatif_id = $al;
                        $penilaian->periode_id = $nilaiAlternatif->id;
                        $penilaian->kriteria_id = $request->input($k->kode)[$kunci];
                        $penilaian->sub_kriteria_id = $request->input('sub_'.$k->kode)[$kunci];
                        $penilaian->save();
                    }
                }
                return redirect()->route('nilai-alternatif.index')
                            ->with('sukses', 'Penilaian berhasil ditambahkan');
            }
            return redirect()->route('nilai-alternatif.index')
                            ->with('gagal', 'Penilaian gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nilaiAlternatif = NilaiAlternatif::find($id);
        $forTtl = explode("-", $nilaiAlternatif->waktu);
        $nilaiAlternatif->waktu = $forTtl['1'].'-'.$forTtl['2'].'-'.$forTtl['0'];
        $alternatif = Alternatif::all();
        $data = array();
        $kriteria = Kriteria::all();

        foreach ($alternatif as $key => $al) {
            $penilaianTmp = DB::table('penilaian')
                            ->join('sub_kriteria', 'sub_kriteria.id', '=', 'penilaian.sub_kriteria_id')
                            ->join('alternatif', 'alternatif.id', '=', 'penilaian.alternatif_id')
                            ->join('nilai_alternatif', 'nilai_alternatif.id', '=', 'penilaian.periode_id')
                            ->where([
                                    'penilaian.periode_id' => $nilaiAlternatif->id,
                                    'penilaian.alternatif_id' => $al->id 
                            ])
                            ->select('penilaian.id', 'penilaian.sub_kriteria_id','penilaian.kriteria_id', 'sub_kriteria.keterangan')
                            ->get();
            foreach ($penilaianTmp as $kunci => $nil) {
                if(!isset($data[$key])) {
                    $data[$key] = new \StdClass();
                }
                $data[$key]->id = $al->id;
                $data[$key]->nama = $al->nama;
                $data[$key]->periode_id = $nilaiAlternatif->id;
                $data[$key]->kriteria_id[$kunci] = $nil->kriteria_id;
                $data[$key]->sub_kriteria_id[$kunci] = $nil->sub_kriteria_id;
                $data[$key]->sub_kriteria[$kunci] = $nil->keterangan;
            }
        }

        return view('nilai_alternatif.show', [
            'nilaiAlternatif' => $nilaiAlternatif,
            'kriteria' => $kriteria,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                        'periode' => 'required|unique:nilai_alternatif,periode,'.$id,
                        'waktu' => 'required',
                    ],
                    [
                        'periode.required' => 'Periode wajib diisi',
                        'periode.unique' => 'Periode sudah digunakan',
                        'waktu.required' => 'Tanggal wajib diisi',
                    ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $nilaiAlternatif = NilaiAlternatif::find($id);
            preg_match_all('!\d+!', $request->waktu, $tanggal);
            $nilaiAlternatif->periode = $request->periode;
            $nilaiAlternatif->waktu = $tanggal[0][2].'-'.$tanggal[0][0].'-'.$tanggal[0][1];
            $nilaiAlternatifSave = $nilaiAlternatif->save();

            if ($nilaiAlternatifSave) {
                return redirect()->route('nilai-alternatif.index')
                            ->with('sukses', 'Nilai Alternatif berhasil diupdate');
            }
            return redirect()->route('nilai-alternatif.index')
                            ->with('gagal', 'Nilai Alternatif gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $periode = NilaiAlternatif::find($id);
        $penilaian = Penilaian::where('periode_id',$periode->id)->get();

        if (count($penilaian) > 0) {
            foreach ($penilaian as $key => $value) {
                $value->delete();
            }
            $periode->delete();
        } else {
            $periode->delete();
        }
        
        return redirect()->route('nilai-alternatif.index')->with('sukses', 'Periode penilaian berhasil dihapus');
    }


    public function edit_penilaian($per_id, $al_id)
    {
        $alternatif = Alternatif::find($al_id);
        $penilaian = DB::table('penilaian')
                        ->join('alternatif', 'alternatif.id', '=', 'penilaian.alternatif_id')
                        ->join('sub_kriteria', 'sub_kriteria.id', '=', 'penilaian.sub_kriteria_id')
                        ->join('kriteria', 'kriteria.id', '=', 'penilaian.kriteria_id')
                        ->join('nilai_alternatif', 'nilai_alternatif.id', '=', 'penilaian.periode_id')
                        ->where([
                                        'penilaian.periode_id' => $per_id,
                                        'alternatif_id' => $al_id,
                                ])
                        ->select('penilaian.id', 'penilaian.periode_id', 'penilaian.sub_kriteria_id', 'kriteria.nama', 'kriteria.kode', 'kriteria.id as kriteria_id')
                        ->get();
        $kriteria = Kriteria::all();
        $data = array();

        foreach ($kriteria as $key => $k) {
            $subKriteriaTmp = SubKriteria::where('kriteria_id',$k->id)->get();
            foreach ($subKriteriaTmp as $kunci => $sk) {
                if(!isset($data[$key])) {
                    $data[$key] = new \StdClass();
                }
                $data[$key]->id[$kunci] = $sk->id;
                $data[$key]->keterangan[$kunci] = $sk->keterangan;
            }
        }

        return view('nilai_alternatif.edit', [
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'alternatif' => $alternatif,
            'periode' => $per_id,
            'data' => $data
        ]);
    }


    public function update_penilaian(Request $request, $per_id, $al_id)
    {
        foreach ($request->kriteria as $key => $k) {
            $penilaianTmp = Penilaian::where([
                                        'alternatif_id' => $al_id,
                                        'periode_id' => $per_id,
                                        'kriteria_id' => $k
                                    ])
                                    ->first();
            $penilaianTmp->sub_kriteria_id = $request->sub_kriteria[$key];
            $penilaianTmp->save();
        }

        return redirect()->route('nilai-alternatif.edit', $per_id)
                            ->with('sukses', 'Penilaian berhasil diupdate'); 
    }


    public function proses_penilaian($periode)
    {
        $jumBobot = DB::table('kriteria')->sum('bobot');
        $step1 = [];
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        $periodeData = NilaiAlternatif::find($periode);
        // normalisasi bobot
        foreach ($kriteria as $key => $k) {
            $tmp = 0;
            $tmp = $k->bobot/$jumBobot;
            $step1[$k->kode] = $tmp;
        }
        
        $step2 = [];
        // step 2 rating kecocokan
        foreach ($alternatif as $key => $al) {
            $penilaianTmp = DB::table('penilaian')
                        ->join('alternatif', 'alternatif.id', '=', 'penilaian.alternatif_id')
                        ->join('sub_kriteria', 'sub_kriteria.id', '=', 'penilaian.sub_kriteria_id')
                        ->join('kriteria', 'kriteria.id', '=', 'penilaian.kriteria_id')
                        ->join('nilai_alternatif', 'nilai_alternatif.id', '=', 'penilaian.periode_id')
                        ->where([
                                        'penilaian.periode_id' => $periode,
                                        'alternatif_id' => $al->id,
                                ])
                        ->select('penilaian.id', 'penilaian.sub_kriteria_id', 'kriteria.nama', 'kriteria.kode', 'penilaian.kriteria_id as kriteria_id', 'penilaian.alternatif_id', 'alternatif.nama as alternatif', 'sub_kriteria.keterangan', 'sub_kriteria.bobot as sub_bobot', 'kriteria.bobot','kriteria.jenis' )
                        ->get();

            foreach ($penilaianTmp as $kunci => $nilai) {
                if(!isset($step2[$key])) {
                    $step2[$key] = new \StdClass();
                }
                $step2[$key]->id = $nilai->id;
                $step2[$key]->alternatif_id = $nilai->alternatif_id;
                $step2[$key]->alternatif_nama = $nilai->alternatif;
                $step2[$key]->kriteria_id[$kunci] = $nilai->kriteria_id;
                $step2[$key]->sub_kriteria_id[$kunci] = $nilai->sub_kriteria_id;
                $step2[$key]->kriteria[$kunci] = $nilai->nama;
                $step2[$key]->kode[$kunci] = $nilai->kode;
                $step2[$key]->keterangan[$kunci] = $nilai->keterangan;
                $step2[$key]->sub_bobot[$kunci] = $nilai->sub_bobot;
                $step2[$key]->bobot[$kunci] = $nilai->bobot;
                $step2[$key]->jenis[$kunci] = $nilai->jenis;
            }
        }
        // dd($step2);
        $subKriteriaData = [];
        foreach ($kriteria as $key => $value) {
            $sub = SubKriteria::where('kriteria_id',$value->id)->get();
            foreach ($sub as $key2 => $s) {
                if(!isset($subKriteriaData[$key])) {
                    $subKriteriaData[$key] = new \StdClass();
                }
                $subKriteriaData[$key]->kriteria = $value->nama;
                $subKriteriaData[$key]->sub_kriteria[$key2] = $s->keterangan;  
                $subKriteriaData[$key]->bobot_sub[$key2] = $s->bobot;  
            }
        }

    // perhitungan vector S
        $step3 = [];
        $jumVectorS = 0;
        foreach ($step2 as $key => $s) {
            $remanen2 = null;
            $tmp = null;
            $tmp2 = 1;
            if(!isset($step3[$key])) {
                $step3[$key] = new \StdClass();
            }
            $step3[$key]->alternatif = $s->alternatif_nama;
            foreach ($s->sub_bobot as $key2 => $nilai) {
                $remanen = null;
                if ($s->jenis[$key2] == 1) {
                    $tmp = pow($nilai, $step1[$s->kode[$key2]]);
                    $remanen = "(".$nilai."^".$step1[$s->kode[$key2]].")";
                } else {
                    $tmp = pow($nilai,-$step1[$s->kode[$key2]]);
                    $remanen = "(".$nilai."^-".$step1[$s->kode[$key2]].")";
                }
                $tmp2 = $tmp2 * $tmp;
                if (is_null($remanen2)) {
                    $remanen2 = $remanen;
                } else {
                    $remanen2 =  $remanen2 . ' * '. $remanen;
                }      
            }
            $step3[$key]->perhitungan = $remanen2;
            $step3[$key]->nilai = $tmp2;
            $jumVectorS+= $tmp2;
        }

        // perhitungan vector V
        $step4 = [];
        foreach ($step3 as $key => $value) {
            if(!isset($step4[$key])) {
                $step4[$key] = new \StdClass();
            }
            $step4[$key]->nilai = $value->nilai/$jumVectorS;
            $step4[$key]->perhitungan = $value->nilai.' / '.$jumVectorS;
            $step4[$key]->alternatif = $value->alternatif;
        }

        // perankingan
        $sort = collect($step4);
        $ranking = $sort->sortByDesc('nilai');
        $label = [];
        $dataset = [];
        foreach ($ranking as $key => $value) {
            array_push($label, $value->alternatif);
            array_push($dataset, $value->nilai);
        }

        $penilaianChart = new PenilaianChart;
        $penilaianChart->labels($label);
        $penilaianChart->dataset('Hasil Penilaian', 'line', $dataset)
                         ->color("rgb(255, 99, 132)")
                        ->backgroundcolor("rgb(255, 99, 132)");

        return view('nilai_alternatif.nilai', [
            'kriteria' => $kriteria,
            'subKriteriaData' => $subKriteriaData,
            'step1' => $step1,
            'step2' => $step2,
            'step3' => $step3,
            'step4' => $step4,
            'ranking' => $ranking,
            'jumBobot' => $jumBobot,
            'periodeData' => $periodeData,
            'jumVectorS' => $jumVectorS,
            'penilaianChart' => $penilaianChart,
            'label' => json_encode($label),
            'dataset' => json_encode($dataset,JSON_NUMERIC_CHECK)
        ]);
    }
}
