<?php

namespace App\Http\Controllers;

use App\Models\Halaman;
use App\Models\Metadata;
use Illuminate\Http\Request;

class PengaturanHalamanController extends Controller
{
    public function index()
    {
        $data = Halaman::orderBy('judul', 'asc')->get();
        return view("dashboard.pengaturanhalaman.index", compact('data'));
    }

    public function update(Request $request)
    {
        Metadata::updateOrCreate(['meta_key' => '_halaman_about'], ['meta_value' => $request->_halaman_about]);
        Metadata::updateOrCreate(['meta_key' => '_halaman_interest'], ['meta_value' => $request->_halaman_interest]);
        Metadata::updateOrCreate(['meta_key' => '_halaman_award'], ['meta_value' => $request->_halaman_award]);
        return redirect()->route('pengaturanhalaman.index')->with('success', 'Pengaturan halaman sukses ditambahkan');
    }
}
