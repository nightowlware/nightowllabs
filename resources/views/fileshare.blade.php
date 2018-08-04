@extends('layouts.app')

@section('content')
<div class="container">
    <p>
        <strong>File Share</strong>
        <br>
        Simply drag&drop a file in here, then share the link. The file is not guaranteed to be hosted for more than a few days.
    </p>
    <hr>
</div>


<script src="{{ asset('js/dropzone.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">

<form action="{{ route('fileshare') }}" enctype="multipart/form-data" class="dropzone" id="fileshare-dropzone">
    @csrf
</form>
@endsection
