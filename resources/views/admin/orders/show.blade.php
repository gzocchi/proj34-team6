@extends('layouts.app')

@section('content')

<section class="order_show">

    {{-- @foreach ($dishes as $dish) --}}

      <div class="card my-5">
          <div class="card-header text-center d-flex justify-content-between">
              <span class="font-weight-bold">-- Visualizzazione Ordine --</span>
              <div>   
              <p class="text-center font-weight-bold">{{ substr($order['created_at'], 0, 10) }}</p>
              <p class="font-weight-bold">{{ substr($order['created_at'], 11, 8) }}</p>
              </div>
          </div>
      
          <div class="card-body">
      
              <ul class="list-group list-group-flush my-4">
                  <li class="list-group-item">
                      <p class="text-uppercase font-weight-bold d-inline-block">Utente:</p> {{ $order['customer_name'] }}
                    </li>
                  <li class="list-group-item">
                      <p class="text-uppercase font-weight-bold d-inline-block">Indirizzo:</p> {{ $order['customer_address'] }}</li>
                  <li class="list-group-item">
                      <p class="text-uppercase font-weight-bold d-inline-block">Numero di telefono:</p> {{ $order['customer_telephone'] }}</li>
                  
                  <li class="list-group-item text-center">
                      <p class="text-uppercase font-weight-bold d-inline-block">Dettaglio ordine:
                  </li>
                    <ul class="list-group list-group-flush my-4">
                        @foreach ($dishes as $dish)
                        <li class="list-group-item d-inline-block">
                            <img class="img-fluid rounded float-left" src="{{ asset('storage/' . Arr::get($dish, 'img')) }}" alt="{{ Arr::get($dish, 'name') }}">
                            <p class="text-uppercase font-weight-bold d-inline-block ml-5">{{ $dish['name'] }} <span class="badge badge-info"> x {{ $dish['pivot']['quantity'] }}</span> </p> </li>
                        @endforeach
                        <li class="list-group-item text-center"><p class="text-uppercase font-weight-bold d-inline-block">Totale:</p> {{ $order['price'] }} &euro;</li>
                  </ul>
              </ul>
      
              <div class="text-center">
      
                  <a href="{{ route("admin.orders.index") }}" class="text-uppercase btn my_btn btn-info text-white font-weight-bold my-3">Lista ordini</a>
                  <a href="{{ route("admin.home") }}" class="text-uppercase btn my_btn btn-primary font-weight-bold">Dashboard</a>
      
              </div>
      
          </div>
      
      </div>

  {{-- @endforeach --}}

</section>
 
@endsection