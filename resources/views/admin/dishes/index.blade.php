@extends('layouts.app')

@section('content')
<section>

    @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
    @endif
    
        @foreach ($dishes as $dish)
        <ul>
            <li>
                {{ Arr::get($dish, 'name')}}
                <ul>
                    <li>{{ $dish->description}}</li>
                    <li>{{ $dish->price}}</li>
                    <li>{{ $dish->img}}</li>
                </ul>
            </li>
        </ul>
        
        <div>
            <a href="{{ route("admin.dishes.show", Arr::get($dish, 'id')) }}" class="btn btn-sm btn-outline-info">Show</a>
            
            <form 
            action="{{ route('admin.restaurants.destroy', Arr::get($dish, 'id')) }}" method="POST"
            onSubmit = "return confirm(`Cancellare l'articolo '{{ addslashes(Arr::get($dish, 'name')) }}'?`)"
            >
            @csrf
            @method('DELETE')
        
                <button type="submit" class="btn btn-sm btn-danger text-uppercase">Delete</button>
        
            </form>
        </div>
        @endforeach

@endsection