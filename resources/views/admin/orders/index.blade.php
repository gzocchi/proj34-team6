@extends('layouts.app')

@section('content')

@if ($orders != null)

<section class="orders">

    @if ($orders)
        
        @foreach ($orders as $order)

            <div class="card my-5">
                <div class="card-header text-center">
                    <span class="font-weight-bold">-- Panoramica Ordine --</span>
                    <div class="mt-1 text-right">   
                    <span class="text-center font-weight-bold mr-3">{{ substr($order['created_at'], 0, 10) }}</span>
                    <span class="font-weight-bold">{{ substr($order['created_at'], 11, 8) }}</span>
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
        
    @else
            
            <h1>Nessun ordine da mostrare</h1>
        
    @endif


</section>

@else

<section>

    <h1 class="text-center my-5">Nessun ordine da mostrare</h1>

    <div class="text-center my-5">
  
        <a href="{{ route("admin.home") }}" class="btn my_btn btn-primary">Dashboard</a>

    </div>

</section>

@endif
 
@endsection