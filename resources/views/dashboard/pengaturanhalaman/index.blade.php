@extends('dashboard.layout')
@section('content')
<div class="pb-3">
    <a href="{{ route('pengaturanhalaman.index') }}" class="btn btn-secondary">
        << Kembali</a>
</div>
@if (Session::has('success'))
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

<form action="{{ route('pengaturanhalaman.update') }}" method="POST">
    @csrf
    <div class="form-group row">
        <label for="" class="col-sm-2">About</label>
        <div class="col-sm-6">
            <select name="_halaman_about" id="" class="form-control form-control-sm">
                <option value="">-pilih-</option>
                @foreach ($data as $item)
                    <option value="{{ $item->id }}" {{ get_meta_value('_halaman_about') == $item->id ? 'selected' : '' }}>{{ $item->judul }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2">Interest</label>
        <div class="col-sm-6">
            <select name="_halaman_interest" id="" class="form-control form-control-sm">
                <option value="">-pilih-</option>
                @foreach ($data as $item)
                    <option value="{{ $item->id }}" {{ get_meta_value('_halaman_interest') == $item->id ? 'selected' : '' }}>{{ $item->judul }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="" class="col-sm-2">Awards</label>
        <div class="col-sm-6">
            <select name="_halaman_award" id="" class="form-control form-control-sm">
                <option value="">-pilih-</option>
                @foreach ($data as $item)
                    <option value="{{ $item->id }}" {{ get_meta_value('_halaman_award') == $item->id ? 'selected' : '' }}>{{ $item->judul }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button class="btn btn-primary" type="submit" name="simpan">Save</button>
</form>
@endsection
