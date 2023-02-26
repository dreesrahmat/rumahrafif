@extends('dashboard.layout')
@section('content')
<p class="card-title">Experience</p>
<div class="pb-3">
    <a href="{{ route('experience.create') }}" class="btn btn-primary">+ Experience</a>
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
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-1">No</th>
                <th>Posisi</th>
                <th>Nama Perusahaan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Akhir</th>
                <th class="col-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->info1 }}</td>
                <td>{{ $item->tgl_mulai_indo }}</td>
                <td>{{ $item->tgl_akhir_indo }}</td>
                <td>
                    <a href="{{ route('experience.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form onsubmit="return confirm('Yakin mau hapus data ini?')" action="{{ route('experience.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
