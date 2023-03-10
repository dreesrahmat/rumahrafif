<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HalamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $halaman = Halaman::query()->latest();
            return DataTables()->of($halaman)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '<a data-toggle="modal" href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-primary btn-sm modal-edit">EDIT</a> <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm data-hapus">DELETE</a>';
                        return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.halaman.index');
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
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul'     => 'required',
            'deskripsi'   => 'required',
        ], [
            'judul.required' => 'judul halaman harus diisi',
            'deskripsi.required' => 'deskripsi halaman harus diisi',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = Halaman::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Halaman $halaman)
    {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $halaman
        ]);
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
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul'     => 'required',
            'deskripsi'   => 'required',
        ], [
            'judul.required' => 'judul halaman harus diisi',
            'deskripsi.required' => 'deskripsi halaman harus diisi',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $halaman->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diupdate!',
            'data'    => $data
        ]);
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
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Halaman Berhasil Dihapus!.',
        ]);
    }
}
