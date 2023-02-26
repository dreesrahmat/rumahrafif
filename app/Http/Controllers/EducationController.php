<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EducationController extends Controller
{
    function __construct()
    {
        $this->_tipe = 'education';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Riwayat::where('tipe', $this->_tipe)->orderBy('tgl_akhir', 'desc')->get();
        return view('dashboard.education.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return view('dashboard.education.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('judul', $request->judul);
        Session::flash('info1', $request->info1);
        Session::flash('info2', $request->info2);
        Session::flash('info3', $request->info3);
        Session::flash('tgl_mulai', $request->tgl_mulai);
        Session::flash('tgl_akhir', $request->tgl_akhir);
        $request->validate(
            [
            'judul' => 'required',
            'info1' => 'required',
            'info2' => 'required',
            'info3' => 'required',
            'tgl_mulai' => 'required',
            ],
            [
                'judul.required' => 'Nama Universitas wajib diisi',
                'info1.required' => 'Nama Fakultas wajib diisi',
                'info2.required' => 'Nama Prodi wajib diisi',
                'info3.required' => 'IPK wajib diisi',
                'tgl_mulai.required' => 'Tanggal Mulai wajib diisi',
            ]
        );

        $data = [
            'judul' => $request->judul,
            'info1' => $request->info1,
            'info2' => $request->info2,
            'info3' => $request->info3,
            'tipe' => $this->_tipe,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
        ];
        Riwayat::create($data);
        return redirect()->route('education.index')->with('success', 'education berhasil ditambahkan');
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
    public function edit(Riwayat $riwayat)
    {
        $data = $riwayat->where('tipe', $this->_tipe)->first();
        return view('dashboard.education.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Riwayat $riwayat)
    {
        $request->validate(
            [
            'judul' => 'required',
            'info1' => 'required',
            'info2' => 'required',
            'info3' => 'required',
            'tgl_mulai' => 'required',
            ],
            [
                'judul.required' => 'Universitas wajib diisi',
                'info1.required' => 'Nama Fakultas wajib diisi',
                'info2.required' => 'Nama Prodi wajib diisi',
                'info3.required' => 'IPK wajib diisi',
                'tgl_mulai.required' => 'Tanggal Mulai wajib diisi',
            ]
        );

        $data = [
            'judul' => $request->judul,
            'info1' => $request->info1,
            'info2' => $request->info2,
            'info3' => $request->info3,
            'tipe' => $this->_tipe,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'deskripsi' => $request->deskripsi,
        ];

        $riwayat->where('tipe', $this->_tipe)->update($data);
        return redirect()->route('education.index')->with('success', 'education berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Riwayat $riwayat)
    {
        $riwayat->where('tipe', $this->_tipe)->delete();
        return redirect()->route('education.index')->with('success', 'education berhasil dihapus');
    }
}
