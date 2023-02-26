@extends('dashboard.layout')
@section('content')
<p class="card-title">Halaman</p>
<div class="pb-3">
    <a href="{{ route('halaman.create') }}" class="btn btn-primary">+ Halaman</a>
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
    <table class="table table-striped" id="table-halaman">
        <thead>
            <tr>
                <th class="col-1">No</th>
                <th>Judul</th>
                <th class="col-2">Aksi</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
@endsection
@push('after-script')
   <script>
       $(document).ready(function() {
           $('#table-halaman').DataTable({
               processing: true,
               serverSide: true,
               ajax: "{{ route('halaman.index') }}",
               columns:
					[
						{
							name: 'id',
							render: function(data, type, full, meta) {
								return meta.row + 1;
							}
						},
						{data: 'judul', name: 'judul'},
						{data: 'action', name: 'action', orderable: false, searchable: false},
					]
           });
       });
   </script>
@endpush
