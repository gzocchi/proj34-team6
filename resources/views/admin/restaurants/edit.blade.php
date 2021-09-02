@extends('layouts.app')

@section('content')
<section class="py-4">
    
    <h1 class="mb-1">Modifica - <span class="text-info">{{ $restaurant->name }}</span></h1>

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
                maxlength="11"
                value="{{ old('p_iva', $restaurant->p_iva) }}"
                required>
            </div>

            <div class="form-group col-md-4">
                <label for="shipping">Spese di spedizione</label>
                <input type="number"
                class="form-control @error('shipping') is-invalid @enderror"
                id="shipping"
                placeholder="Spese di spedizione"
                name="shipping"
                value="{{ old('shipping', $restaurant->shipping) }}"
                min="0"
                max="99"
                required>
            </div>
            <div class="form-group col-md-4">
                <label for="shipping_free">Spedizione gratuita da</label>
                <input type="number"
                class="form-control @error('shipping_free') is-invalid @enderror"
                id="shipping_free"
                placeholder="Spedizione gratuita"
                name="shipping_free"
                value="{{ old('shipping_free', $restaurant->shipping_free) }}"
                min="0"
                max="999"
                >
            </div>
        </div>

        <div class="form-row">

            @if ($restaurant->logo)
                <div class="col-md-2">
                    <img class="img-fluid" src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{ $restaurant->name }}"> 
                </div>
            @endif
            <div class="form-group col-md-4 offset-md-2 my-3">
                <label for="logo" class="custom-file-label">Modifica Logo</label>
                <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror" id="logo">
            </div>
        </div>

        <div class="form-row">
            @if ($restaurant->bg_image)
                <div class="col-md-2">
                    <img class="img-fluid" src="{{ asset('storage/' . $restaurant->bg_image) }}" alt="{{ $restaurant->name }}"> 
                </div>
            @endif
            <div class="form-group col-md-4 offset-md-2 my-3">
                <label for="bg_image" class="custom-file-label">Modifica Immagine</label>
                <input type="file" name="bg_image" class="custom-file-input @error('bg_image') is-invalid @enderror" id="bg_image">
            </div>

        </div>
        
        

        <div class="text-center mt-4">
            <a href="{{ route("admin.restaurants.index") }}" class="btn btn-sm btn-info text-uppercase">torna al ristorante</a>
            <button type="submit" class="btn btn-sm btn-success text-uppercase">Salva modifiche</button>
        </div>
        
      </form>
    </form>
    
</section>
@endsection