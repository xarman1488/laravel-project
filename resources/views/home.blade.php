@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @auth
                            <h5>Привет!, {{ Auth::user()->name }}!</h5>
                        @endauth
                        <p>Вы вошли в систему!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
