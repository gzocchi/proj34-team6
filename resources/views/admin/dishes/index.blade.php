@extends('layouts.app')

@section('content')
<section class="dishes">

    @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
    @endif

    <div class="row mb-5">
        <a href="{{ route("admin.restaurants.show", Arr::get($dishes[0], 'restaurant_id')) }}" class="btn my_btn btn-primary mr-3">Torna al Ristorante</a>
        <a class="btn btn-success" href="{{ route('admin.dishes.create') }}">Aggiungi piatto</a>
    </div>
    
    @foreach ($dishes as $dish)

    <div class="row dish_row text-center p-4 my-3">
        <div class="col-12 col-md-2">
            @if (Arr::get($dish, 'img'))
                <img class="img-fluid" src="{{ asset('storage/' . Arr::get($dish, 'img')) }}" alt="{{ Arr::get($dish, 'name') }}">
            @else
                <img class="img-fluid" src="{{ asset('images/placeholder_dish.svg') }}" alt="{{ Arr::get($dish, 'name') }}">
            @endif
        </div>
        <div class="col-12 col-md-8">

            <span class=" badge my_badge my-2">{{ $dish->category->name}}</span>
            <h4>{{ Arr::get($dish, 'name')}} - <span>{{ $dish->price}} €</span></h4>
            <p>{{ $dish->description}}</p>
            
        </div>
        <div class="col-12 text-center">
            <a href="{{ route("admin.dishes.edit", Arr::get($dish, 'id')) }}" class="btn btn-sm my_btn btn-success">Modifica</a>
            
            <form
            class="d-inline"
            action="{{ route('admin.dishes.destroy', Arr::get($dish, 'id')) }}" method="POST"
            onSubmit = "return confirm(`Cancellare l'articolo '{{ addslashes(Arr::get($dish, 'name')) }}'?`)"
            >
            @csrf
            @method('DELETE')
        
                <button type="submit" class="btn btn-sm btn-danger text-uppercase">Elimina</button>
        
            </form>
        </div>
    </div>

        
    @endforeach

@endsection