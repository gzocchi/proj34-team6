@extends('layouts.app')

@section('content')
<section>

    @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
    @endif

    <a class="nav-link" href="{{ route('admin.dishes.create') }}">Aggiungi piatto</a>
    
        @foreach ($dishes as $dish)
        <ul>
            <li>
                {{ Arr::get($dish, 'name')}}
                <ul>
                    <li>{{ $dish->description}}</li>
                    <li>{{ $dish->price}}</li>
                    <li>{{ $dish->img}}</li>
                    <li>categoria: {{ $dish->category->name}}</li>
                    <li>ristorante: {{ $dish->restaurant->name}}</li>
                </ul>
            </li>
        </ul>

        @if (Arr::get($dish, 'img'))
            <img class="img-fluid d-block" src="{{ asset('storage/' . Arr::get($dish, 'img')) }}" alt="{{ Arr::get($dish, 'name') }}">
        @else
            <img class="img-fluid d-block" src="{{ asset('images/placeholder_dish.svg') }}" alt="{{ Arr::get($dish, 'name') }}">
        @endif
        
        <div>
            <a href="{{ route("admin.dishes.edit", Arr::get($dish, 'id')) }}" class="btn btn-sm btn-outline-info">Modifica</a>
            
            <form 
            action="{{ route('admin.dishes.destroy', Arr::get($dish, 'id')) }}" method="POST"
            onSubmit = "return confirm(`Cancellare l'articolo '{{ addslashes(Arr::get($dish, 'name')) }}'?`)"
            >
            @csrf
            @method('DELETE')
        
                <button type="submit" class="btn btn-sm btn-danger text-uppercase">Delete</button>
        
            </form>
        </div>
        @endforeach

@endsection