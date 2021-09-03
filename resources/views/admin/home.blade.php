@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="text-center my-4">Admin Home</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Auth::user()->name }} {{ __('you are logged in!') }}
                </div>

                @if (Auth::user()->restaurants()->first())
                    <a class="nav-link" href="{{ route('admin.restaurants.index') }}">Il mio ristorante</a>
                @else
                    <a class="nav-link" href="{{ route('admin.restaurants.create') }}">Crea ristorante</a>
                @endif
                <a class="nav-link" href="#">Ordini</a>
            </div>
        </div>
    </div>
</div>
@endsection
