@extends('layouts.app')

@section('content')
<div class="container">
    <p>
        <strong>Advanced: POST Echo Tester</strong>
        <br>
        This page shows the last several http POSTs that were sent to this endpoint. Try it out: POST some data
        to <i>{{ url()->current() }}</i>, then hit refresh. <strong>WARNING:</strong> This is a shared public page, do not post sensitive data!
    </p>
    <hr>

    @foreach ($echoPosts as $e)
        <div>
            <pre>
<strong>RECEIVED</strong>
{{ $e->created_at }}
<br>
<strong>HEADERS</strong>
{{ $e->headers }}
<br>
<strong>BODY</strong>
{{ $e->body }}
            </pre>
        </div>
        <hr>
    @endforeach

</div>
@endsection
