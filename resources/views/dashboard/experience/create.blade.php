@extends('dashboard.layout')
@section('content')
<div class="pb-3">
    <a href="{{ route('experience.index') }}" class="btn btn-secondary">
        << Kembali</a>
</div>
<form action="{{ route('experience.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="judul" class="form-label">Posisi</label>
        <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror" name="judul" id="judul" aria-describedby="helpId"
            placeholder="Posisi" value="{{ Session::get('judul') }}">
        @error('judul')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="info1" class="form-label">Nama Perusahaan</label>
        <input type="text" class="form-control form-control-sm @error('info1') is-invalid @enderror" name="info1" id="info1" aria-describedby="helpId"
            placeholder="Nama Perusahaan" value="{{ Session::get('info1') }}">
        @error('info1')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col-auto">Tanggal Mulai</div>
            <div class="col-auto">
                <input type="date" class="form-control form-control-sm" name="tgl_mulai" placeholder="dd/mm/yyyy" value="{{ Session::get('tgl_mulai') }}">
            </div>
            <div class="col-auto">Tanggal Akhir</div>
            <div class="col-auto">
                <input type="date" class="form-control form-control-sm" name="tgl_akhir" placeholder="dd/mm/yyyy" value="{{ Session::get('tgl_akhir') }}">
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control summernote @error('title') is-invalid @enderror">{{ Session::get('deskripsi') }}</textarea>
        @error('deskripsi')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button class="btn btn-primary" type="submit" name="simpan">Save</button>
</form>
@endsection
