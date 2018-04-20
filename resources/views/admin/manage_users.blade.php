@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>User Search</h3>
                        {{ Form::open(['method' => 'get']) }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('nameInput', 'Name') }}
                                    {{ Form::text('searchName', old('searchName'), ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1">
                                {{ Form::submit('Search', ['class' => 'btn btn-primary pull-right']) }}
                            </div>
                            <div class="col-md-1">
                                <a href="{{ url('/admin/users') }}" class="btn btn-primary pull-right">
                                    Clear
                                </a>
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
                                <th>Delete?</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->is_super_user ? "Yes" : "No" }}</td>
                                    <td>{{ $user->created_at }}</td>
{{--                                    <td><a href="/view-log/{{ $log->id }}">View</a></td>--}}
                                    <td>
                                        {{ Form::open(
                                            ['action' => ['AdminUserController@destroy', 'id' => "$user->id"],
                                             'method' => 'DELETE'])
                                        }}

                                        {!! Form::submit('Delete',
                                            ['type' => 'submit', 'class' => 'btn btn-primary pull-right', 'onsubmit' => 'return ConfirmDelete()']) !!}
                                        {{ Form::close() }}
                                    </td>
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

