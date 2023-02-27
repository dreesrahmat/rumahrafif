@extends('dashboard.layout')
@section('content')
<div class="pb-3">
    <a href="{{ route('halaman.index') }}" class="btn btn-secondary">
        << Kembali</a>
</div>
<form action="{{ route('halaman.update', $halaman->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror" name="judul"
            id="judul" aria-describedby="helpId" placeholder="Judul" value="{{ $halaman->judul }}">
        @error('judul')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="" cols="30" rows="10"
            class="form-control summernote @error('title') is-invalid @enderror">{{ $halaman->deskripsi }}</textarea>
        @error('deskripsi')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button class="btn btn-primary" type="submit" name="simpan">Save</button>
</form>
@endsection
