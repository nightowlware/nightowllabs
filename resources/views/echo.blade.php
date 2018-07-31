@extends('layouts.app')

@section('content')
<div class="container">
    <p>
        <strong>Advanced: POST Echo Tester</strong>
        <br>
        This page shows the last several http POSTs that were sent to this endpoint.
    </p>
    <hr>

    @foreach ($echoPosts as $e)
        <div>
            <pre>
{!! $e->html !!}
            </pre>
        </div>
        <hr>
    @endforeach

</div>
@endsection
