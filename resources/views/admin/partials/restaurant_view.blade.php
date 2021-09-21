<div class="row my-4">
    {{-- container restaurant  --}}
    <div class="container container-restaurant">

        {{-- immagine  --}}
        <div class="col-4 col-md-4">
            @if (Arr::get($restaurant, 'logo'))
                <img class="img-fluid " src="{{ asset('storage/' . Arr::get($restaurant, 'logo')) }}" alt="{{ Arr::get($restaurant, 'name') }}">
            @else
                <img class="img-fluid img-thumbnail" src="{{ asset('images/placeholder_dish.svg') }}" alt="{{ Arr::get($restaurant, 'name') }}">
            @endif
        </div>

        {{-- nome  --}}
        <div class="title col-8 col-md-4 d-flex flex-column justify-content-center">
            <h2>
                {{ Arr::get($restaurant, 'name') }}
                @if (count($restaurant->types) > 0)
                
                    @foreach ($restaurant->types as $type)
                    <span class=" badge-absolute badge badge-info text-light">{{ Arr::get($type, 'name') }}</span>   
                    @endforeach  
                
                @endif
            </h2>
            <h6 class="card-subtitle mb-2 text-muted">P.IVA: {{ Arr::get($restaurant, 'p_iva') }}</h6>

            <ul class="list-group list-group-flush">
                <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Indirizzo:</p> {{ Arr::get($restaurant, 'address') }}</li>
                @if (Arr::get($restaurant, 'shipping') == 0)
                    <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Spedizione gratuita</p></li>
                @else
                    <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Spese di spedizione:</p> {{ Arr::get($restaurant, 'shipping') }} €</li>
                    @if (Arr::get($restaurant, 'shipping_free') > 0)
                        <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Spedizione gratuita per ordini superiori a: <span class="font-weight-light">{{ Arr::get($restaurant, 'shipping_free') }}€</span></p></li>
                    @endif
                @endif
            </ul>
        </div>

        {{-- bottoni  --}}
        <div class="container-buttons flex col-md-4 col-12">
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
        {{-- voto  --}}
        <div class="col-12 container-voto">
            @if (Arr::get($restaurant, 'vote'))
            <span><p class="font-weight-bold d-inline-block">Media voto ristorante:</p> {{ Arr::get($restaurant, 'vote') }}/5</span> 
            @else
            <span>Il tuo ristorante non ha ancora ricevuto recensioni</span> 
            @endif
        </div>
        
    </div>
</div>