@extends('layouts.app')

@section('content')
<section class="restaurant">

    @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
    @endif

    <div class="row my-4">

        <div class="col-12 col-md-2">
            @if (Arr::get($restaurant, 'logo'))
                <img class="img-fluid " src="{{ asset('storage/' . Arr::get($restaurant, 'logo')) }}" alt="{{ Arr::get($restaurant, 'name') }}">
            @else
                <img class="img-fluid img-thumbnail" src="{{ asset('images/placeholder_dish.svg') }}" alt="{{ Arr::get($restaurant, 'name') }}">
            @endif
        </div>

        <div class="title col-12 col-md-8 d-flex flex-column justify-content-center align-items-center">

            <h1 class="text-center">{{ Arr::get($restaurant, 'name') }}</h1>

        </div>

    </div>

    <div class="card">

        <div class="card-header text-center">
            -- Info Ristorante --
        </div>

        <div class="card-body">

            <h5 class="card-title text-center">{{ Arr::get($restaurant, 'name') }}</h5>
            <h6 class="card-subtitle mb-2 text-center text-muted">P.IVA: {{ Arr::get($restaurant, 'p_iva') }}</h6>

            @if (count($restaurant->types) > 0)
            <div class="text-center">
                @foreach ($restaurant->types as $type)
                <span class="badge badge-info text-light">{{ Arr::get($type, 'name') }}</span>   
                @endforeach  
            </div>
            @endif

            <ul class="list-group list-group-flush my-4">
                <li class="list-group-item">Indirizzo: {{ Arr::get($restaurant, 'address') }}</li>
                @if (Arr::get($restaurant, 'shipping') == 0)
                    <li class="list-group-item">Spedizione gratuita</li>
                @else
                    <li class="list-group-item">Spese di spedizione: {{ Arr::get($restaurant, 'shipping') }} €</li>
                    @if (Arr::get($restaurant, 'shipping_free') > 0)
                        <li class="list-group-item">Spedizione gratuita per ordini superiori a {{ Arr::get($restaurant, 'shipping_free') }} €</li>
                    @endif
                @endif
            </ul>

            <div class="text-center">

                <a href="{{ route("admin.dishes.index") }}" class="btn btn-success mr-2">Menu ristorante</a>
                <a href="{{ route("admin.restaurants.edit", Arr::get($restaurant, 'id')) }}" class="btn btn-primary mr-2">Modifica Ristorante</a>
                <form 
                    class="d-inline"
                    action="{{ route('admin.restaurants.destroy', Arr::get($restaurant, 'id')) }}"
                    method="POST"
                    onSubmit = "return confirm(`Cancellare definitivamente il ristorante '{{ addslashes(Arr::get($restaurant, 'name')) }}'?`)"
                    >
                    @csrf
                    @method('DELETE')
                
                    <button type="submit" class="btn btn-danger text-uppercase">Elimina Ristorante</button>
                
                </form>

            </div>

        </div>

        @if (Arr::get($restaurant, 'bg_image'))
            <img src="{{ asset('storage/' . Arr::get($restaurant, 'bg_image')) }}" class="card-img-top" alt="{{ Arr::get($restaurant, 'name') }}">
        @endif

        <div class="card-footer text-center text-muted">
            @if (Arr::get($restaurant, 'vote'))
            Il voto del tuo ristorante: {{ Arr::get($restaurant, 'vote') }}
            @else
            Il tuo ristorante non ha ancora ricevuto votazioni
            @endif
        </div>

    </div>

</section>
@endsection