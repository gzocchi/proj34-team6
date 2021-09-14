@extends('layouts.app')

@section('content')

@if (count($orders) > 0)

<section class="orders">

    @foreach ($orders as $order)

        <div class="card my-5">
            <div class="card-header text-center d-flex justify-content-between">
                <span class="font-weight-bold">-- Panoramica Ordine --</span>
                <div>   
                <p class="text-center font-weight-bold">{{ substr($order['created_at'], 0, 10) }}</p>
                <p class="font-weight-bold">{{ substr($order['created_at'], 11, 8) }}</p>
                </div>
            </div>
        
            <div class="card-body">
        
                <ul class="list-group list-group-flush my-4">
                        <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Utente:</p> {{ $order['customer_name'] }}</li>
                        <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Totale:</p> {{ $order['price'] }} &euro;</li>
                </ul>
        
                <div class="text-center">
        
                    <a href="{{ route("admin.orders.show", $order['id']) }}" class="text-uppercase btn my_btn btn-info text-white font-weight-bold mr-3">Dettaglio ordine</a>
                    <a href="{{ route("admin.home") }}" class="text-uppercase btn my_btn btn-primary font-weight-bold">Dashboard</a>
        
                </div>
        
            </div>
        
        </div>

    @endforeach

</section>

@else

<section>

    <h1 class="text-center">Nessun ordine da mostrare</h1>

    <div>
  
        <a href="{{ route("admin.home") }}" class="btn my_btn btn-primary">Dashboard</a>

    </div>

</section>

@endif
 
@endsection