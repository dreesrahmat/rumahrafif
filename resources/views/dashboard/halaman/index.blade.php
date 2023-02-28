@extends('dashboard.layout')
@section('content')
<p class="card-title">Halaman</p>
<div class="pb-3">
    <a href="javascript:void(0)" class="btn btn-primary modal-create">+ Halaman</a>
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
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">FORM HALAMAN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-halaman">
                    <div class="form-group">
                        <label for="judul" class="control-label">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-title"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="4"></textarea>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-content"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="store">SIMPAN</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                    </div>
                </form>
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
            lengthMenu: [5, 10, 25, 50],
            pageLength: 5,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'judul',name: 'judul'},
                {data: 'action',name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
<script>
    $(function () {
        /* Menambahkan modal javascript dan tambah data halaman */
        $('.modal-create').click(function () {
            $('#modal-form').modal('show');
            $('input[name="judul"]').val('');
            $('textarea[name="deskripsi"]').val('');
            $('.form-halaman').submit(function (e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    url: "{{ route('halaman.store') }}",
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
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
                        }
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
        });

        /* Menambahkan modal javascript dan update data halaman */
        $(document).on('click', '.modal-edit', function () {
            $('#modal-form').modal('show');
            const id = $(this).data('id');
            $.get('/dashboard/halaman/' + id, function ({
                data
            }) {
                $('input[name="judul"]').val(data.judul);
                $('textarea[name="deskripsi"]').val(data.deskripsi);
                $('.form-halaman').submit(function (e) {
                    e.preventDefault();
                    const formData = new FormData(this);
                    $.ajax({
                        url: `/dashboard/halaman/${id}?_method=PUT`,
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.success) {
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
                            }
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
            });
        });

        /* Menghapus data halaman */
        $(document).on('click', '.data-hapus', function () {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "ingin menghapus data ini!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'TIDAK',
                confirmButtonText: 'YA, HAPUS!'
            }).then((result) => {
                if (result.isConfirmed) {
                    //fetch to delete data
                    $.ajax({
                        url: `/dashboard/halaman/${id}`,
                        type: "DELETE",
                        cache: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
                            //remove post on table
                            $('#table-halaman').DataTable().ajax.reload();
                        }
                    });
                }
            })
        });
    });
</script>
@endpush
