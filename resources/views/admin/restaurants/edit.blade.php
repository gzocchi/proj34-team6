@extends('layouts.app')

@section('content')
<section class="restaurant_edit">
    
    <h1 class="text-center mb-1 text-info">{{ $restaurant->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p class="my-1">{{ $error }}</p>
            @endforeach            
        </div>
    @endif
    
    <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-row mt-4">

            <div class="form-group col-md-4">
                <label for="name">Nome</label>
                <input type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                placeholder="Inserisci il nome"
                name="name"
                maxlength="60"
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
                minlength="11"
                maxlength="11"
                value="{{ old('p_iva', $restaurant->p_iva) }}"
                required>
            </div>
        </div>

        <div class="form-row mt-4">

            <div class="form-group col-md-4">
                <label for="shipping">Spese di spedizione</label>
                <input type="number"
                class="form-control @error('shipping') is-invalid @enderror"
                id="shipping"
                placeholder="0"
                name="shipping"
                value="{{ old('shipping', $restaurant->shipping) }}"
                min="0"
                max="99"
                step="0.01"
                required>
            </div>

            <div class="form-group col-md-4">
                <label for="shipping_free">Spedizione gratuita da</label>
                <input type="number"
                class="form-control @error('shipping_free') is-invalid @enderror"
                id="shipping_free"
                placeholder="0"
                name="shipping_free"
                value="{{ old('shipping_free', $restaurant->shipping_free) }}"
                min="0"
                max="999"
                step="0.01"
                >
            </div>

        </div>

        <div class="form-row mt-4">

            <div class="col-md-4">
                <div class="form-group my-3">
                    <label for="logo" class="custom-file-label">Modifica Logo</label>
                    <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror" id="logo">
                </div>
                <div class="text-center">
                    @if ($restaurant->logo)
                    <img class="img-fluid " src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{ $restaurant->name }}"> 
                    @else
                    <img class="img-fluid img-thumbnail" src="{{ asset('images/placeholder_dish.svg') }}" alt="{{ Arr::get($restaurant, 'name') }}">
                    @endif
                </div>
            </div>

            <div class="col-md-4 offset-md-4">
                <div class="form-group my-3">
                    <label for="bg_image" class="custom-file-label">Modifica Immagine</label>
                    <input type="file" name="bg_image" class="custom-file-input @error('bg_image') is-invalid @enderror" id="bg_image">
                </div>
                <div class="text-center">
                    @if ($restaurant->bg_image)
                    <img class="img-fluid" src="{{ asset('storage/' . $restaurant->bg_image) }}" alt="{{ $restaurant->name }}"> 
                    @else
                    <img class="img-fluid img-thumbnail" src="{{ asset('images/placeholder_dish.svg') }}" alt="{{ Arr::get($restaurant, 'name') }}">
                    @endif
            </div>
            </div>

        </div>

        <div class="form-group col-md-8 offset-md-2 my-3 text-center">

            @foreach ($types as $type)
                <div class="form-check form-check-inline">
                    @if ($errors->any())
                        <input class="form-check-input"
                        type="checkbox"
                        id="tag-{{ $type->id }}"
                        value="{{ $type->id }}"
                        name="types[]"
                        {{ in_array($type->id, old('types', [])) ? 'checked' : '' }}
                        >
                    @else
                        <input class="form-check-input"
                        type="checkbox"
                        id="tag-{{ $type->id }}"
                        value="{{ $type->id }}"
                        name="types[]"
                        {{ $restaurant->types->contains($type->id) ? 'checked' : '' }}
                        > 
                    @endif
                    <label class="form-check-label" for="tag-{{ $type->id }}">{{ $type->name }}</label>
                </div>     
            @endforeach

        </div>

        <div class="text-center mt-4">
            <a href="{{ route("admin.restaurants.show", Arr::get($restaurant, 'id')) }}" class="btn btn-sm my_btn btn-primary text-uppercase">torna al ristorante</a>
            <button type="submit" class="btn btn-sm btn-success text-uppercase">Salva modifiche</button>
        </div>
        
      </form>
    </form>
    
</section>
@endsection