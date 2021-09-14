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

</section>

@endif
 
@endsection