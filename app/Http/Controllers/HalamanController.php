<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
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
        if (request()->ajax()) {
            $halaman = Halaman::query()->latest();
            return DataTables()->of($halaman)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <a href="' . route('halaman.edit', $item->id) . '" class="btn btn-primary btn-sm">
                                <i class="fa fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form action="' . route('halaman.destroy', $item->id) . '" method="POST">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    ';
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
