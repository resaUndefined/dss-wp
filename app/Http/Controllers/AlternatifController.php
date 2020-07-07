<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Alternatif;
use App\Model\Penilaian;
use DB;
use Validator;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gender = DB::raw("(CASE WHEN gender='1' THEN 'laki-laki' ELSE 'perempuan' END) as gender");
        $umur = DB::raw("(TIMESTAMPDIFF(YEAR, ttl, CURDATE())) as ttl");
        $alternatif = DB::table('alternatif')->select('id','nama','jabatan',$gender, $umur)->paginate(10);

        return view('alternatif.index', [
            'alternatif' => $alternatif
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alternatif.create');
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
                        'jabatan' => 'required|numeric',
                        'alamat' => 'required|string',
                        'ttl' => 'required',
                        'gender' => 'required|boolean',
                    ],
                    [
                        'nama.required' => 'Nama wajib diisi',
                        'nama.string' => 'Format nama tidak sesuai',
                        'jabatan.required' => 'Jabatan wajib diisi',
                        'jabatan.numeric' => 'Format jabatan tidak sesuai',
                        'alamat.required' => 'Alamat wajib diisi',
                        'alamat.string' => 'Format alamat tidak sesuai',
                        'ttl.required' => 'Tanggal lahir wajib diisi',
                        'gender.required' => 'Jenis kelamin wajib diisi',
                        'gender.boolean' => 'Format jenis kelamin tidak sesuai',
                    ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $alternatif = new Alternatif();
            preg_match_all('!\d+!', $request->ttl, $ttl);
            $jabatan = null;
            if ($request->jabatan == 1) {
                $jabatan = 'DIV TI';
            }elseif ($request->jabatan == 2) {
                $jabatan = 'Marketing';
            }
            elseif ($request->jabatan == 3) {
                $jabatan = 'HRD';
            }elseif ($request->jabatan == 4) {
                $jabatan = 'Petugas Kebersihan';
            }elseif ($request->jabatan == 5) {
                $jabatan = 'Petugas Keamanan';
            }elseif ($request->jabatan == 6) {
                $jabatan = 'Quality Assurance';
            }else {
                $jabatan = 'Manajer';
            }
            $alternatif->nama = $request->nama;
            $alternatif->jabatan = $jabatan;
            $alternatif->alamat = $request->alamat;
            $alternatif->ttl = $ttl[0][2].'-'.$ttl[0][0].'-'.$ttl[0][1];
            $alternatif->gender = $request->gender;
            $alternatifSave = $alternatif->save();

            if ($alternatifSave) {
                return redirect()->route('alternatif.index')
                            ->with('sukses', 'Alternatif berhasil ditambahkan');
            }
            return redirect()->route('alternatif.index')
                            ->with('gagal', 'Alternatif gagal ditambahkan');
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
        $alternatif = Alternatif::find($id);
        $forTtl = explode("-", $alternatif->ttl);
        $alternatif->ttl = $forTtl['1'].'-'.$forTtl['2'].'-'.$forTtl['0'];
        if ($alternatif->jabatan == 'DIV TI') {
                $alternatif->jabatan = 1;
            }elseif ($alternatif->jabatan == 'Marketing') {
                $alternatif->jabatan = 2;
            }
            elseif ($alternatif->jabatan == 'HRD') {
                $alternatif->jabatan = 3;
            }elseif ($alternatif->jabatan == 'Petugas Kebersihan') {
                $alternatif->jabatan = 4;
            }elseif ($alternatif->jabatan == 'Petugas Keamanan') {
                $alternatif->jabatan = 5;
            }elseif ($alternatif->jabatan == 'Quality Assurance') {
                $alternatif->jabatan = 6;
            }else {
                $alternatif->jabatan = 7;
            }
            
        return view('alternatif.edit', [
                    'alternatif' => $alternatif
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
                        'jabatan' => 'required|numeric',
                        'alamat' => 'required|string',
                        'ttl' => 'required',
                        'gender' => 'required|boolean',
                    ],
                    [
                        'nama.required' => 'Nama wajib diisi',
                        'nama.string' => 'Format nama tidak sesuai',
                        'jabatan.required' => 'Jabatan wajib diisi',
                        'jabatan.numeric' => 'Format jabatan tidak sesuai',
                        'alamat.required' => 'Alamat wajib diisi',
                        'alamat.string' => 'Format alamat tidak sesuai',
                        'ttl.required' => 'Tanggal lahir wajib diisi',
                        'gender.required' => 'Jenis kelamin wajib diisi',
                        'gender.boolean' => 'Format jenis kelamin tidak sesuai',
                    ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $alternatif = Alternatif::find($id);
            preg_match_all('!\d+!', $request->ttl, $ttl);
            $jabatan = null;
            if ($request->jabatan == 1) {
                $jabatan = 'DIV TI';
            }elseif ($request->jabatan == 2) {
                $jabatan = 'Marketing';
            }
            elseif ($request->jabatan == 3) {
                $jabatan = 'HRD';
            }elseif ($request->jabatan == 4) {
                $jabatan = 'Petugas Kebersihan';
            }elseif ($request->jabatan == 5) {
                $jabatan = 'Petugas Keamanan';
            }elseif ($request->jabatan == 6) {
                $jabatan = 'Quality Assurance';
            }else {
                $jabatan = 'Manajer';
            }
            $alternatif->nama = $request->nama;
            $alternatif->jabatan = $jabatan;
            $alternatif->alamat = $request->alamat;
            $alternatif->ttl = $ttl[0][2].'-'.$ttl[0][0].'-'.$ttl[0][1];
            $alternatif->gender = $request->gender;
            $alternatifSave = $alternatif->save();

            if ($alternatifSave) {
                return redirect()->route('alternatif.index')
                            ->with('sukses', 'Alternatif berhasil diupdate');
            }
            return redirect()->route('alternatif.index')
                            ->with('gagal', 'Alternatif gagal diupdate');
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
        $alternatif = Alternatif::find($id);
        $penilaian = Penilaian::where('alternatif_id',$alternatif->id)->get();

        if (count($penilaian) > 0) {
            foreach ($penilaian as $key => $value) {
                $value->delete();
            }
            $alternatif->delete();
        } else {
            $alternatif->delete();
        }

        return redirect()->route('alternatif.index')->with('sukses', 'Alternatif berhasil dihapus');    
    }

}
