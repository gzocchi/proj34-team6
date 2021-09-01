@extends('layouts.app')

@section('content')
<section class="restaurant_table">

    @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
    @endif
@php
// dump($restaurants->id)
    // dd($restaurants)
@endphp
    <table class="my-3 table table-striped table-bordered table-responsive-md">
        <thead class="table-dark text-uppercase">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Slug</th>
            <th>Tipo</th>
            <th colspan="3" class="text-center">Azioni</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($restaurants as $item)
            @php
// dump($restaurants->id)
    // dd($item)
@endphp
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->slug }}</td>

                    <td>
                        @if ($item->types()->first()->name)
                            @foreach ($item->types()->get() as $type)
                                {{ $type->name }}
                            @endforeach
                        @else
                            N/D
                        @endif
                    </td>

                    <td class="text-uppercase text-center align-middle">
                        <a href="{{ route("admin.restaurants.show", $item->id) }}" class="btn btn-sm btn-outline-success">Show</a>
                    </td>
                    <td class="text-uppercase text-center align-middle">
                        <a href="{{ route("admin.restaurants.edit", $item->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                    </td>
                    <td class="text-uppercase text-center align-middle">
                        <form 
                            action="{{ route('admin.restaurants.destroy', $item->id) }}" method="POST"
                            onSubmit = "return confirm(`Cancellare l'articolo '{{ addslashes($item->name) }}'?`)">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger text-uppercase">Delete</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>

</section>
@endsection