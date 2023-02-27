@extends('dashboard.layout')
@section('content')
<p class="card-title">Halaman</p>
<div class="pb-3">
    <a href="javascript:void(0)" class="btn btn-primary" id="btn-create-post">+ Halaman</a>
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

<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">TAMBAH HALAMAN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="control-label">Judul</label>
                    <input type="text" class="form-control" id="judul">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                </div>
                <div class="form-group">
                    <label class="control-label">Deskripsi</label>
                    <textarea name="deskripsi summernote" class="form-control" id="deskripsi" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-content"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="store">SIMPAN</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('after-script')
<script>
    $(document).ready(function () {
        $('#table-halaman').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('halaman.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'judul',name: 'judul'},
                {data: 'action',name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
<script>
    //button create post event
    $('body').on('click', '#btn-create-post', function () {

        //open modal
        $('#modal-create').modal('show');
    });

    //action create post
    $('#store').click(function (e) {
        e.preventDefault();

        //define variable
        let judul = $('#judul').val();
        let deskripsi = $('#deskripsi').val();
        let token = $("meta[name='csrf-token']").attr("content");

        //ajax
        $.ajax({

            url: "{{ route('halaman.store') }}",
            type: "POST",
            cache: false,
            data: {
                "judul": judul,
                "deskripsi": deskripsi,
                "_token": token
            },
            success: function (response) {

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                //clear form
                $('#judul').val('');
                $('#deskripsi').val('');
                //close modal
                $('#modal-create').modal('hide');
                $('#table-halaman').DataTable().ajax.reload();
            },
            error: function (error) {

                if (error.responseJSON.judul[0]) {

                    //show alert
                    $('#alert-title').removeClass('d-none');
                    $('#alert-title').addClass('d-block');

                    //add message to alert
                    $('#alert-title').html(error.responseJSON.judul[0]);
                }

                if (error.responseJSON.deskripsi[0]) {

                    //show alert
                    $('#alert-content').removeClass('d-none');
                    $('#alert-content').addClass('d-block');

                    //add message to alert
                    $('#alert-content').html(error.responseJSON.deskripsi[0]);
                }
            }
        });
    });
</script>
@endpush
