@extends('layouts.app')

@section('content')
<div id="app" class="container">
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">Dashboard</div>--}}

                {{--<div class="card-body">--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    {{--You are logged in.--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    @if (session('message'))
        <div id="messageToast" class="floating-message alert alert-success" role="alert">
            {{--@php--}}
            {{--session(['message' => "Test Message!"]);--}}
            {{--@endphp--}}
            <b> {{ session('message') }} </b>
        </div>
    @endif

    @if ($errorMsg = session('errorMessage'))
        <div id="errorMessageToast" class="floating-message alert alert-danger" role="alert">
            {{--@php--}}
            {{--session(['message' => "Test Message!"]);--}}
            {{--@endphp--}}
            <b> {{ $errorMsg }} </b>
        </div>
    @endif

    <dashboard></dashboard>

</div>
@endsection
