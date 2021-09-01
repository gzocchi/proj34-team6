@extends('layouts.app')

@section('content')
<section class="py-4">

    @if (session('message'))
        <div class="alert alert-info mb-4">
            {{ session('message') }}
        </div>
    @endif
    
    <div class="title mb-4">
        <small>{{ $restaurant->slug }}</small>
        <h1 class="text-info">{{ $restaurant->name }}</h1>
    </div>    
 
    <div class="row">
        <div class="col-md-4">
            @if ($restaurant->logo)
                <img class="img-fluid" src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{ $restaurant->name }}">
            @else 
                <img class="img-fluid" src="{{ asset('images/placeholder.png') }}" alt="{{ $restaurant->name }}">    
            @endif
        </div>
        <div class="col-md-4">
            @if ($restaurant->bg_image)
                <img class="img-fluid" src="{{ asset('storage/' . $restaurant->bg_image) }}" alt="{{ $restaurant->name }}">
            @else 
                <img class="img-fluid" src="{{ asset('images/placeholder.png') }}" alt="{{ $restaurant->name }}">    
            @endif
        </div>
    </div>

    
    <div class="text-center mt-4">
        <a href="{{ route("admin.restaurants.index") }}" class="btn btn-sm btn-info text-uppercase">Index</a>
        <a href="{{ route("admin.restaurants.edit", $restaurant->id) }}" class="btn btn-sm btn-outline-info text-uppercase">Edit</a>
    </div>

</section>
@endsection