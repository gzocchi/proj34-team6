{{-- <div class="row my-4">

    <div class="col-12 col-md-2">
        @if (Arr::get($restaurant, 'logo'))
            <img class="img-fluid " src="{{ asset('storage/' . Arr::get($restaurant, 'logo')) }}" alt="{{ Arr::get($restaurant, 'name') }}">
        @else
            <img class="img-fluid img-thumbnail" src="{{ asset('images/placeholder_dish.svg') }}" alt="{{ Arr::get($restaurant, 'name') }}">
        @endif
    </div>

    <div class="title col-12 col-md-8 d-flex flex-column justify-content-center align-items-center">

        <h1 class="text-center">{{ Arr::get($restaurant, 'name') }}</h1>

    </div>

</div> --}}

<div class="card my-5">

    <div class="card-header text-center">
        <span>-- Info Ristorante --</span> 
    </div>

    <div class="card-body">

        <h5 class="card-title text-center">{{ Arr::get($restaurant, 'name') }}</h5>
        <h6 class="card-subtitle mb-2 text-center text-muted">P.IVA: {{ Arr::get($restaurant, 'p_iva') }}</h6>

        @if (count($restaurant->types) > 0)
        <div class="text-center">
            @foreach ($restaurant->types as $type)
            <span class="badge badge-info text-light">{{ Arr::get($type, 'name') }}</span>   
            @endforeach  
        </div>
        @endif

        <ul class="list-group list-group-flush my-4">
            <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Indirizzo:</p> {{ Arr::get($restaurant, 'address') }}</li>
            @if (Arr::get($restaurant, 'shipping') == 0)
                <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Spedizione gratuita</p></li>
            @else
                <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Spese di spedizione:</p> {{ Arr::get($restaurant, 'shipping') }} €</li>
                @if (Arr::get($restaurant, 'shipping_free') > 0)
                    <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Spedizione gratuita per ordini superiori a</p> {{ Arr::get($restaurant, 'shipping_free') }} €</li>
                @endif
            @endif
        </ul>

        <div class="text-center">
            
            @if (count($restaurant->dishes) > 0)
                <a href="{{ route("admin.dishes.index") }}" class="text-uppercase font-weight-bold btn btn-success mr-2">Menu ristorante</a>
            @else
                <a href="{{ route("admin.dishes.create") }}" class="text-uppercase font-weight-bold btn btn-success mr-2">Aggiungi il tuo primo piatto</a>
            @endif
            <a href="{{ route("admin.restaurants.edit", Arr::get($restaurant, 'id')) }}" class="text-uppercase font-weight-bold btn my_btn btn-primary mr-2">Modifica Ristorante</a>
            <form 
                class="d-inline"
                action="{{ route('admin.restaurants.destroy', Arr::get($restaurant, 'id')) }}"
                method="POST"
                onSubmit = "return confirm(`Cancellare definitivamente il ristorante '{{ addslashes(Arr::get($restaurant, 'name')) }}'?\nTutti i piatti del Menu verranno eliminati definitivamente`)"
                >
                @csrf
                @method('DELETE')
            
                <button type="submit" class="text-uppercase font-weight-bold btn btn-danger text-uppercase">Elimina Ristorante</button>
            
            </form>

        </div>

    </div>

    {{-- @if (Arr::get($restaurant, 'bg_image'))
        <img src="{{ asset('storage/' . Arr::get($restaurant, 'bg_image')) }}" class="card-img-top" alt="{{ Arr::get($restaurant, 'name') }}">
    @endif --}}

    <div class="card-footer text-center text-muted">
        @if (Arr::get($restaurant, 'vote'))
        <span><p class="font-weight-bold d-inline-block">Media voto ristorante:</p> {{ Arr::get($restaurant, 'vote') }}/5</span> 
        @else
        <span>Il tuo ristorante non ha ancora ricevuto recensioni</span> 
        @endif
    </div>

</div>