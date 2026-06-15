@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @auth
                            <h5>Welcome, {{ Auth::user()->name }}!</h5>
                        @endauth
                        <p>You are logged in!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
