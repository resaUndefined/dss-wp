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
        //
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
}
