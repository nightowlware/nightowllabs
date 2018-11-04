@extends('layouts.app')

@section('content')
<div class="container">
    <p>
        <strong>Phaser Playground</strong>
        <br>
    </p>
    <hr>

    <div id="game">
    </div>

</div>
@endsection


@section('js')
<script src="{{ asset('js/phaser.min.js') }}"></script>
<script src="{{ asset('js/game1.js') }}"></script>

@endsection

