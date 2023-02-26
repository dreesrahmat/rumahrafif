@extends('dashboard.layout')
@section('content')
<div class="pb-3">
    <a href="{{ route('skill.index') }}" class="btn btn-secondary">
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


<form action="{{ route('skill.update') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="judul" class="form-label">PROGRAMMING LANGUAGES & TOOLS</label>
        <input type="text" class="form-control skill form-control-sm @error('title') is-invalid @enderror" name="_language"
            id="judul" aria-describedby="helpId" placeholder="PROGRAMMING LANGUAGES & TOOLS"
            value="{{ get_meta_value('_language') }}">
        @error('judul')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">WORKFLOW</label>
        <textarea name="_workflow" id="" cols="30" rows="10"
            class="form-control summernote @error('title') is-invalid @enderror">{{ get_meta_value('_workflow') }}</textarea>
        @error('deskripsi')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button class="btn btn-primary" type="submit" name="simpan">Save</button>
</form>
@endsection
@push('child-scripts')
    <script>
        $(document).ready(function() {
            $('.skill').tokenfield({
                autocomplete: {
                    source: [{!! $skill !!}],
                    delay: 100
                },
                showAutocompleteOnFocus: true
            });
        });
    </script>
@endpush
