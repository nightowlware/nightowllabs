@extends('layouts.app')

@section('content')
<div class="container">
    <p>
        <strong>Warning: this is a technical tool.</strong>
        <br>
        This page shows the last several http POSTs that were sent to this address.
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
