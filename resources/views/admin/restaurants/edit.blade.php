@extends('layouts.app')

@section('content')
<section class="py-4">
    
    <h1 class="mb-1">Modifica - <span class="text-info">{{ $restaurant->name }}</span></h1>
    <a href="{{ route("admin.restaurants.show", $restaurant ?? ''->id) }}" class="btn btn-sm btn-outline-success text-uppercase">Show</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p class="my-1">{{ $error }}</p>
            @endforeach            
        </div>
    @endif
    
    <form action="{{ route('admin.restaurants.update', $restaurant ?? ''->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-row my-4">
            <div class="form-group col-md-4">
                <label for="name">Nome</label>
                <input type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                placeholder="Inserisci il nome"
                name="name"
                value="{{ old('name', $restaurant->name) }}"
                required>
            </div>
            <div class="form-group col-md-4">
                <label for="address">Indirizzo</label>
                <input type="text"
                class="form-control @error('address') is-invalid @enderror"
                id="address"
                placeholder="Inserisci l'indirizzo"
                name="address"
                value="{{ old('address', $restaurant->address) }}"
                required>
            </div>
            <div class="form-group col-md-4">
                <label for="p_iva">Partita IVA</label>
                <input type="text"
                class="form-control @error('p_iva') is-invalid @enderror"
                id="p_iva"
                placeholder="Partita IVA"
                name="p_iva"
                value="{{ old('p_iva', $restaurant->p_iva) }}"
                required>
            </div>

            @if ($restaurant->logo)
                <div class="col-md-2">
                    <img class="img-fluid" src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{ $restaurant->name }}"> 
                </div>
            @endif
            @if ($restaurant->bg_image)
                <div class="col-md-2">
                    <img class="img-fluid" src="{{ asset('storage/' . $restaurant->bg_image) }}" alt="{{ $restaurant->name }}"> 
                </div>
            @endif

        </div>
        
        

        <div class="text-center mt-4">
            <a href="{{ route("admin.restaurants.index") }}" class="btn btn-sm btn-info text-uppercase">Index</a>
            <button type="submit" class="btn btn-sm btn-success text-uppercase">Save</button>
        </div>
        
      </form>
    </form>
    
</section>
@endsection