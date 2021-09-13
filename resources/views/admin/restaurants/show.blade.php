@extends('layouts.app')

@section('content')
<section class="restaurant">

    @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
    @endif

    @include('admin.partials.restaurant_view')

</section>
@endsection