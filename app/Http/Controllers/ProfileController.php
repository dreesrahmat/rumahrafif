<?php

namespace App\Http\Controllers;

use App\Models\Metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index');
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                '_foto' => 'mimes:jpeg,jpg,png,gif',
                '_email' => 'required|email',
            ],
            [
                '_foto.mimes' => 'Foto yang dimasukkan hanya diperbolehkan berekstensi jpeg, jpg, png, atau gif',
                '_email.required' => 'Email harus diisi',
                '_email.email' => 'Email yang dimasukkan harus sesuai dengan standar',
            ]
        );

        if ($request->hasFile('_foto')) {
            $foto_file = $request->file('_foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_baru = date('ymhdis') . " .$foto_ekstensi";
            $foto_file->move(public_path('foto'), $foto_baru);
            // kalau ada update foto
            $foto_lama = get_meta_value('_foto');
            File::delete(public_path('foto') . "/" . $foto_lama);

            Metadata::updateOrCreate(['meta_key' => '_foto'],['meta_value' => $foto_baru]);
        }
        Metadata::updateOrCreate(['meta_key' => '_email'], ['meta_value' => $request->_email]);
        Metadata::updateOrCreate(['meta_key' => '_kota'], ['meta_value' => $request->_kota]);
        Metadata::updateOrCreate(['meta_key' => '_provinsi'], ['meta_value' => $request->_provinsi]);
        Metadata::updateOrCreate(['meta_key' => '_nohp'], ['meta_value' => $request->_nohp]);


        Metadata::updateOrCreate(['meta_key' => '_facebook'], ['meta_value' => $request->_facebook]);
        Metadata::updateOrCreate(['meta_key' => '_twitter'], ['meta_value' => $request->_twitter]);
        Metadata::updateOrCreate(['meta_key' => '_linkedin'], ['meta_value' => $request->_linkedin]);
        Metadata::updateOrCreate(['meta_key' => '_github'], ['meta_value' => $request->_github]);
        return redirect()->route('profile.index')->with('success', 'Anda berhasil mengupdate profile');
    }
}
