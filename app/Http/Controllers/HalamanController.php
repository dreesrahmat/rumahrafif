<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HalamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Halaman::orderBy('judul', 'asc')->get();
        return view('dashboard.halaman.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.halaman.create');
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
        Session::flash('deskripsi', $request->deskripsi);
        $validate = $request->validate(
            [
            'judul' => 'required',
            'deskripsi' => 'required',
            ],
            [
                'judul.required' => 'Judul wajib diisi',
                'deskripsi.required' => 'Deskripsi wajib diisi',
            ]
        );

        $data = Halaman::create($validate);
        return redirect()->route('halaman.index')->with('success', 'Halaman berhasil ditambahkan');
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
    public function edit(Halaman $halaman)
    {
        return view('dashboard.halaman.edit', compact('halaman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Halaman $halaman)
    {
        $validate = $request->validate(
            [
            'judul' => 'required',
            'deskripsi' => 'required',
            ],
            [
                'judul.required' => 'Judul wajib diisi',
                'deskripsi.required' => 'Deskripsi wajib diisi',
            ]
        );

        $halaman->update($validate);
        return redirect()->route('halaman.index')->with('success', 'Halaman berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Halaman $halaman)
    {
        $halaman->delete();
        return redirect()->route('halaman.index')->with('success', 'Data berhasil dihapus');
    }
}
