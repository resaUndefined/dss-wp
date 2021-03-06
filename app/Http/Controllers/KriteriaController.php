<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Kriteria;
use App\Model\SubKriteria;
use App\Model\Penilaian;
use DB;
use Validator;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = DB::raw("(CASE WHEN jenis='1' THEN 'benefit' ELSE 'cost' END) as jenis");
        $kriteria = DB::table('kriteria')->select('id','kode','nama','bobot', $jenis)->paginate(10);

        return view('kriteria.index', [
            'kriteria' => $kriteria
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kriteria.create');
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
                        'nama' => 'required|string',
                        'kode' => 'required|unique:kriteria,kode',
                        'jenis' => 'required|boolean',
                        'bobot' => 'required|numeric',
                        'sub_kriteria' => 'required|array',
                        'sub_bobot' => 'required|array',
                    ],
                    [
                        'nama.required' => 'Nama kriteria wajib diisi',
                        'nama.string' => 'Format Nama kriteria tidak sesuai',
                        'kode.required' => 'Kode wajib diisi',
                        'kode.unique' => 'Kode sudah digunakan',
                        'jenis.required' => 'Jenis wajib diisi',
                        'jenis.boolean' => 'Format jenis tidak sesuai',
                        'bobot.required' => 'Bobot wajib diisi',
                        'bobot.numeric' => 'Format bobot tidak sesuai',
                        'sub_kriteria.required' => 'Sub kriteria wajib diisi',
                        'sub_kriteria.array' => 'Format sub kriteria tidak sesuai',
                        'sub_bobot.required' => 'Bobot sub kriteria wajib diisi',
                        'sub_kriteria.array' => 'Format bobot sub kriteria tidak sesuai',
                    ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $kriteria = new Kriteria();
            $kriteria->nama = $request->nama;
            $kriteria->kode = $request->kode;
            $kriteria->jenis = $request->jenis;
            $kriteria->bobot = $request->bobot;
            $kriteriaSave = $kriteria->save();
            if ($kriteriaSave) {
                foreach ($request->sub_kriteria as $key => $sk) {
                    $subKriteria = new SubKriteria();
                    $subKriteria->kriteria_id = $kriteria->id;
                    $subKriteria->keterangan = $sk;
                    $subKriteria->bobot = $request->sub_bobot[$key];
                    $subKriteria->save();
                }
                return redirect()->route('kriteria.index')
                            ->with('sukses', 'Kriteria dan sub kriteria berhasil ditambahkan');
            }
            return redirect()->route('kriteria.index')
                            ->with('gagal', 'Kriteria gagal ditambahkan');
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
        $kriteria = Kriteria::where('id',$id)->first();
        $sub_kriteria = SubKriteria::where('kriteria_id',$kriteria->id)->get();

        return view('kriteria.show', [
            'kriteria' => $kriteria,
            'subKriteria' => $sub_kriteria
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
                        'nama' => 'required|string',
                        'kode' => 'required|unique:kriteria,kode,'. $id,
                        'jenis' => 'required|boolean',
                        'bobot' => 'required|numeric',
                    ],
                    [
                        'nama.required' => 'Nama kriteria wajib diisi',
                        'nama.string' => 'Format Nama kriteria tidak sesuai',
                        'kode.required' => 'Kode wajib diisi',
                        'kode.unique' => 'Kode sudah digunakan',
                        'jenis.required' => 'Jenis wajib diisi',
                        'jenis.boolean' => 'Format jenis tidak sesuai',
                        'bobot.required' => 'Bobot wajib diisi',
                        'bobot.numeric' => 'Format bobot tidak sesuai',
                    ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $kriteria = Kriteria::find($id);
            $kriteria->nama = $request->nama;
            $kriteria->kode = $request->kode;
            $kriteria->jenis = $request->jenis;
            $kriteria->bobot = $request->bobot;
            $kriteriaSave = $kriteria->save();
            if ($kriteriaSave) {
                return redirect()->route('kriteria.index')
                            ->with('sukses', 'Kriteria berhasil diupdate');
            }
            return redirect()->route('kriteria.index')
                            ->with('gagal', 'Kriteria gagal diupdate');
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
        $kriteriaDelete = Kriteria::find($id);
        $subKriteriaDelete = SubKriteria::where('kriteria_id',$kriteriaDelete->id)->get();
        if (count($subKriteriaDelete) > 0) {
            foreach ($subKriteriaDelete as $key => $value) {
                $penilaian = Penilaian::where([
                        'kriteria_id' => $kriteriaDelete->id,
                        'sub_kriteria_id' => $value->id
                ])->get();
                if (count($penilaian) > 0) {
                    foreach ($penilaian as $key2 => $value2) {
                        $value2->delete();
                    }
                    $value->delete();
                } else {
                    $value->delete();
                }
            }
            $kriteriaDelete->delete();
        } else {
            $kriteriaDelete->delete();
        }
        return redirect()->route('kriteria.index')->with('sukses', 'kriteria dan Sub Kriteria berhasil dihapus');
    }


    public function sub_kriteria($id)
    {
        $subKriteria = SubKriteria::where('kriteria_id',$id)->get();

        return view('kriteria.tambah_sub', [
            'idKriteria' => $id,
            'subKriteria' => $subKriteria
        ]);
    }


    public function sub_kriteria_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
                        'keterangan' => 'required|string',
                        'bobot' => 'required|numeric',
                    ],
                    [
                        'keterangan.required' => 'Keterangan kriteria wajib diisi',
                        'keterangan.string' => 'Format Nama keterangan tidak sesuai',
                        'bobot.required' => 'Bobot wajib diisi',
                        'bobot.numeric' => 'Format bobot tidak sesuai',
                    ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $subKriteria = new SubKriteria();
            $subKriteria->kriteria_id = $request->kriteria_id;
            $subKriteria->keterangan = $request->keterangan;
            $subKriteria->bobot = $request->bobot;
            $subKriteriaSave = $subKriteria->save();
            if ($subKriteriaSave) {
                return redirect()->route('kriteria.edit', $request->kriteria_id)
                            ->with('sukses', 'Sub kriteria berhasil ditambahkan');
            }
            return redirect()->route('kriteria.edit', $request->kriteria_id)
                            ->with('gagal', 'Sub kriteria gagal ditambahkan');
        }
    }


    public function sub_kriteria_edit($subKriteriaId)
    {
        $subKriteriaEdit = SubKriteria::find($subKriteriaId);
        $subKriteria = SubKriteria::where(
                                        'id', '!=', $subKriteriaId
                                    )->where(
                                        'kriteria_id', '=', $subKriteriaEdit->kriteria_id
                                    )->get();

        return view('kriteria.edit', [
            'subKriteria' => $subKriteria,
            'subKriteriaEdit' => $subKriteriaEdit
        ]);
    }


    public function sub_kriteria_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
                        'keterangan' => 'required|string',
                        'bobot' => 'required|numeric',
                    ],
                    [
                        'keterangan.required' => 'Keterangan kriteria wajib diisi',
                        'keterangan.string' => 'Format Nama keterangan tidak sesuai',
                        'bobot.required' => 'Bobot wajib diisi',
                        'bobot.numeric' => 'Format bobot tidak sesuai',
                    ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $subKriteria = SubKriteria::find($request->id);
            $subKriteria->keterangan = $request->keterangan;
            $subKriteria->bobot = $request->bobot;
            $subKriteriaSave = $subKriteria->save();
            if ($subKriteriaSave) {
                return redirect()->route('kriteria.edit', $subKriteria->kriteria_id)
                            ->with('sukses', 'Sub kriteria berhasil diupdate');
            }
            return redirect()->route('kriteria.edit', $subKriteria->kriteria_id)
                            ->with('gagal', 'Sub kriteria gagal diupdate');
        }
    }


    public function sub_kriteria_delete($id)
    {
        $subKriteria = SubKriteria::find($id);
        $k = $subKriteria->kriteria_id;
        $penilaian = Penilaian::where('sub_kriteria_id',$id)->get();

        if (count($penilaian) > 0) {
            foreach ($penilaian as $key => $value) {
                $value->delete();
            }
            $subKriteria->delete();
        } else {
            $subKriteria->delete();
        }
        return redirect()->route('kriteria.edit', $k)->with('sukses', 'Sub Kriteria berhasil dihapus');
    }
}
