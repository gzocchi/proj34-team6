@extends('layouts.app')

@section('content')

@if (count($orders) > 0)

<section class="orders">

    @foreach ($orders as $order)

        @include('admin.partials.order_view')

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