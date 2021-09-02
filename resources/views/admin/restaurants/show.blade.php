@extends('layouts.app')

@section('content')
<section class="restaurant_table">

    @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
    @endif


    <h1>{{ Arr::get($restaurant, 'name') }}</h1>

    <ul>
        <li>Address: {{ Arr::get($restaurant, 'address') }}</li>
        <li>P. IVA: {{ Arr::get($restaurant, 'p_iva') }}</li>
        <li>Shipping: {{ Arr::get($restaurant, 'shipping') }}</li>
        <li>Shipping Free: {{ Arr::get($restaurant, 'shipping_free') }}</li>
        <li>Vote: {{ Arr::get($restaurant, 'vote') }}</li>
    </ul>

    <img class="img-fluid" src="{{ asset('storage/' . Arr::get($restaurant, 'logo')) }}" alt="{{ Arr::get($restaurant, 'name') }}">
    <img class="img-fluid" src="{{ asset('storage/' . Arr::get($restaurant, 'bg_image')) }}" alt="{{ Arr::get($restaurant, 'name') }}">

    <div>
        <a href="#" class="btn btn-sm btn-outline-success">Menu</a>
        <a href="{{ route("admin.restaurants.edit", Arr::get($restaurant, 'id')) }}" class="btn btn-sm btn-outline-info">Edit</a>
        <form 
            action="{{ route('admin.restaurants.destroy', Arr::get($restaurant, 'id')) }}" method="POST"
            onSubmit = "return confirm(`Cancellare l'articolo '{{ addslashes(Arr::get($restaurant, 'name')) }}'?`)">
            @csrf
            @method('DELETE')
    
            <button type="submit" class="btn btn-sm btn-danger text-uppercase">Delete</button>
    
        </form>
    </div>