@extends('layouts.app')

@section('content')
<section class="dashboard">

    <h1 class="text-center my-4">Dashboard Ristoratore - {{ Auth::user()->name }}</h1>

    <div class="row flex-column align-content-center">
        {{-- <div class="col-md-8">
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

                @if (count(Auth::user()->restaurants))
                    <a class="nav-link" href="{{ route('admin.restaurants.index') }}">Il mio Ristorante</a>
                @else
                    <a class="nav-link" href="{{ route('admin.restaurants.create') }}">Aggiungi Ristorante</a>
                @endif
                <a class="nav-link" href="#">Ordini</a>
            </div>
        </div> --}}

        <div class="dashboard_card col-10 col-md-4 my-3">
            @if (count(Auth::user()->restaurants) == 1)
                <a class="d-block p-5 font-weight-bolder" href="{{ route('admin.restaurants.show', Auth::user()->restaurants()->first()->id) }}">Il mio Ristorante</a>
            @elseif(count(Auth::user()->restaurants) > 1)
                <a class="d-block p-5 font-weight-bolder" href="{{ route('admin.restaurants.index') }}">I miei Ristoranti</a>
            @else
                <a class="d-block p-5 font-weight-bolder" href="{{ route('admin.restaurants.create') }}">Aggiungi Ristorante</a>
            @endif
        </div>

        <div class="dashboard_card col-10 col-md-4 my-3 {{ (count(Auth::user()->restaurants) == 0) ? 'disabled-link' : '' }}">
            <a class="d-block p-5 font-weight-bolder {{ (count(Auth::user()->restaurants) == 0) ? 'disabled-link' : '' }}" href="{{ route('admin.orders.index')}}">Ordini</a>
        </div>

    </div>
</section>
@endsection

