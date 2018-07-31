@extends('layouts.app')

@section('content')
<div class="container">
    <p>
        <strong>Advanced: POST Echo Tester</strong>
        <br>
        This page shows the last several http POSTs that were sent to this endpoint. Try it out: POST some data
        to <i>{{ Request::url() }}</i>, then hit refresh.
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
