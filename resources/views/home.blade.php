@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in.
                </div>
            </div>
        </div>

        @if (session('message'))
        <div class="floating-message alert alert-success" role="alert">
            {{--@php--}}
            {{--session(['message' => "Test Message!"]);--}}
            {{--@endphp--}}
            <b> {{ session('message') }} </b>
        </div>
        @endif

    </div>
</div>
@endsection
