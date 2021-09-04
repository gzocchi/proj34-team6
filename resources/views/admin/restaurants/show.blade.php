@extends('layouts.app')

@section('content')
<section class="restaurant">

    @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
    @endif

    <div class="title my-4">
        <h1 class="text-center">{{ Arr::get($restaurant, 'name') }}</h1>
    
        <form 
            class="text-center"
            action="{{ route('admin.restaurants.destroy', Arr::get($restaurant, 'id')) }}"
            method="POST"
            onSubmit = "return confirm(`Cancellare l'articolo '{{ addslashes(Arr::get($restaurant, 'name')) }}'?`)"
            >
            @csrf
            @method('DELETE')
        
                <button type="submit" class="btn btn-sm btn-danger text-uppercase">Elimina Ristorante</button>
        
        </form>
    </div>

    @if (count($restaurant->types))
        <div class="my-3">
            <h3>Tipologia ristorante:</h3>
            <ul>
                @foreach ($restaurant->types as $type)
                <li>{{$type->name}}</li>
                @endforeach
            </ul>
        </div>
    @endif
   
    <div class="my-3">
        <h3>Info ristorante:</h3>
        <ul>
            <li>Indirizzo: {{ Arr::get($restaurant, 'address') }}</li>
            <li>P. IVA: {{ Arr::get($restaurant, 'p_iva') }}</li>
            <li>Spedizione: {{ Arr::get($restaurant, 'shipping') }} €</li>
            @if (Arr::get($restaurant, 'shipping_free') > 0)
            <li>Spedizione gratuita sopra: {{ Arr::get($restaurant, 'shipping_free') }} €</li>
            @else
            <li>Spedizione gratuita</li>
            @endif
            @if (Arr::get($restaurant, 'vote'))
            <li>Voto ristorante: {{ Arr::get($restaurant, 'vote') }}</li>
            @endif
                
        </ul>
    </div>

    <div class="row my-3">
        <img class="img-fluid" src="{{ asset('storage/' . Arr::get($restaurant, 'logo')) }}" alt="{{ Arr::get($restaurant, 'name') }}">
        <img class="img-fluid" src="{{ asset('storage/' . Arr::get($restaurant, 'bg_image')) }}" alt="{{ Arr::get($restaurant, 'name') }}">
    </div>

    <div class="text-center my-4">
        <a href="{{ route("admin.dishes.index") }}" class="btn btn-sm btn-outline-success">Menu ristorante</a>
        <a href="{{ route("admin.restaurants.edit", Arr::get($restaurant, 'id')) }}" class="btn btn-sm btn-outline-info">Modifica ristorante</a>
    </div>

</section>
@endsection