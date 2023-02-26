@extends('dashboard.layout')
@section('content')
<div class="pb-3">
    <a href="{{ route('profile.index') }}" class="btn btn-secondary">
        << Kembali</a>
</div>
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
    <script>
        var alertList = document.querySelectorAll('.alert');
        alertList.forEach(function (alert) {
            new bootstrap.Alert(alert)
        })

    </script>
@endif


<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-between">
        <div class="col-5">
            <h3>Profile</h3>
            @if (get_meta_value('_foto'))
                <img src="{{ asset('foto') . "/" . get_meta_value('_foto') }}" alt="" style="max-width: 100px; max-height: 100px">
            @endif
            <div class="mb-3">
                <label for="_foto" class="form-label">Foto</label>
                <input type="file" class="form-control form-control-sm @error('_foto') is-invalid @enderror"
                    name="_foto" id="_foto" aria-describedby="helpId" placeholder="Foto"
                    value="{{ get_meta_value('_foto') }}">
                @error('_foto')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="_kota" class="form-label">Kota</label>
                <input type="text" class="form-control form-control-sm @error('_kota') is-invalid @enderror"
                    name="_kota" id="_kota" aria-describedby="helpId" placeholder="Kota"
                    value="{{ get_meta_value('_kota') }}">
                @error('_kota')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="_provinsi" class="form-label">Provinsi</label>
                <input type="text" class="form-control form-control-sm @error('_provinsi') is-invalid @enderror"
                    name="_provinsi" id="_provinsi" aria-describedby="helpId" placeholder="Provinsi"
                    value="{{ get_meta_value('_provinsi') }}">
                @error('_provinsi')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="_nohp" class="form-label">Nomor Hp</label>
                <input type="text" class="form-control form-control-sm @error('_nohp') is-invalid @enderror"
                    name="_nohp" id="_nohp" aria-describedby="helpId" placeholder="Nomor Hp"
                    value="{{ get_meta_value('_nohp') }}">
                @error('_nohp')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="_email" class="form-label">Email</label>
                <input type="email" class="form-control form-control-sm @error('_email') is-invalid @enderror"
                    name="_email" id="_email" aria-describedby="helpId" placeholder="Email"
                    value="{{ get_meta_value('_email') }}">
                @error('_email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-5">
            <h3>Akun Media Sosial</h3>
            <div class="mb-3">
                <label for="_facebook" class="form-label">Facebook</label>
                <input type="text" class="form-control form-control-sm @error('_facebook') is-invalid @enderror"
                    name="_facebook" id="_facebook" aria-describedby="helpId" placeholder="Facebook"
                    value="{{ get_meta_value('_facebook') }}">
                @error('_facebook')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="_twitter" class="form-label">Twitter</label>
                <input type="text" class="form-control form-control-sm @error('_twitter') is-invalid @enderror"
                    name="_twitter" id="_twitter" aria-describedby="helpId" placeholder="Twitter"
                    value="{{ get_meta_value('_twitter') }}">
                @error('_twitter')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="_linkedin" class="form-label">Linkedin</label>
                <input type="text" class="form-control form-control-sm @error('_linkedin') is-invalid @enderror"
                    name="_linkedin" id="_linkedin" aria-describedby="helpId" placeholder="Linkedin"
                    value="{{ get_meta_value('_linkedin') }}">
                @error('_linkedin')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="_github" class="form-label">Github</label>
                <input type="text" class="form-control form-control-sm @error('_github') is-invalid @enderror"
                    name="_github" id="_github" aria-describedby="helpId" placeholder="Github"
                    value="{{ get_meta_value('_github') }}">
                @error('_github')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <button class="btn btn-primary" type="submit" name="simpan">Save</button>
</form>
@endsection
