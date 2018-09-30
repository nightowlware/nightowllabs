@extends('layouts.app')

@section('content')
    <div class="container">
        <strong>Use this page to manage API access via OAuth clients and personal access tokens:</strong>
        <br>
        <ul>
            <li>OAuth clients are applications that needs to access OD on a user's behalf.</li>
            <li>Personal Access Tokens are simple long-lived tokens that are generated then used as a secret during API calls.
                To use a token, simply pass it in the "Authorization" header as "Bearer [token]" when issuing an API call.</li>
        </ul>

        <hr>
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>

        <hr>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
@endsection
