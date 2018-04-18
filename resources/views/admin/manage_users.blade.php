@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>Log Search</h3>
                        {{ Form::open(['url' => '/log-search', 'method' => 'get']) }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('reference_number', 'Reference Number') }}
                                    {{ Form::text('reference_number', old('reference_number'), ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::submit('Search', ['class' => 'btn btn-primary pull-right']) }}
                            </div>
                        </div>
                        {{ Form::close() }}

                        <hr>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Administrator?</th>
                                <th>Date Joined</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->is_super_user ? "Yes" : "No" }}</td>
                                    <td>{{ $user->name }}</td>
{{--                                    <td><a href="/view-log/{{ $log->id }}">View</a></td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
