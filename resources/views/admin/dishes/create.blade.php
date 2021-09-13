@extends('layouts.app')

@section('content')
<section>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p class="my-1">{{ $error }}</p>
            @endforeach            
        </div>
    @endif


    <h1 class="text-center text-info mb-4">Crea piatto</h1>

    <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-row mt-4">

            <div class="form-group col-md-4">
                <label for="name">Nome</label>
                <input type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                placeholder="Inserisci il nome del piatto"
                name="name"
                maxlength="100"
                value="{{ old('name') }}"
                required>
            </div>

            <div class="form-group col-md-4">
                <label for="price">Prezzo</label>
                <input type="number"
                class="form-control @error('price') is-invalid @enderror"
                id="price"
                placeholder="Prezzo"
                name="price"
                value="{{ old('price') }}"
                min="0"
                max="999"
                step="0.01"
                required>
            </div>

        </div>

        <div class="form-row">

            <div class="form-group col-md-4 my-3">
                <label for="img" class="custom-file-label">Carica Immagine</label>
                <input type="file" name="img" class="custom-file-input @error('img') is-invalid @enderror" id="img">
            </div>

            <div class="form-group col-12">
                <label for="description">Descrizione Piatto</label>
                <textarea
                class="form-control @error('description') is-invalid @enderror"
                id="description"
                name="description"
                placeholder="Inserisci ingredienti / descrizione"
                rows="5"
                maxlength="255"
                required>{{ old('description') }}</textarea>
            </div>

        </div>

        <div class="form-group col-md-12 my-3">

            
            @foreach ($categories as $category)
            
            <div class="custom-control custom-radio d-inline">

                <input type="radio" class="custom-control-input"
                id="{{$category->id}}"
                value="{{$category->id}}"
                name="category_id"
                {{ old('category_id') }}
                required>
                <label class="custom-control-label"for="{{$category->id}}">{{ $category->name }}</label>
            </div>

            @endforeach

        </div>

        <div class="form-group col-md-12 my-3">
            <div class="custom-control custom-radio d-inline">
                <input type="radio" id="true" name="visible" value="1" {{old('visible')}} checked class="custom-control-input">
                <label class="custom-control-label" for="true">Piatto visibile</label>
            </div>
            <div class="custom-control custom-radio d-inline">
                <input type="radio" id="false" name="visible" value="0" {{old('visible')}} class="custom-control-input">
                <label class="custom-control-label" for="false">Piatto non visibile</label>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route("admin.dishes.index") }}" class="btn btn-sm my_btn btn-primary text-uppercase">Torna al Menu</a>
            <button type="submit" class="btn btn-sm btn-success text-uppercase">Salva Piatto</button>
        </div>

    </form>


</section>
@endsection