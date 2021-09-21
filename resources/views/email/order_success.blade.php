<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Ordine in preparazione</title>
    </head>
    <body>
          <ul class="">
                <li class="" style="color:red;">{{ $order['restaurant_name'] }}</li>
                <li class="">{{ $order['restaurant_address'] }}</li>
                <li class="">{{ $order['restaurant_telephone'] }}</li>
                <li class="">{{ $order['customer_name'] }}</li>
                <li class="">{{ $order['customer_address'] }}</li>
                <li class="">{{ $order['customer_telephone'] }}</li>
                <li class="">{{ $order['customer_mail'] }}</li>
                @foreach ($order['all_dishes'] as $dish)
                    <li>{{ $dish['quantity'] }} x {{ $dish['name'] }} - {{ $dish['price'] }} &euro;</li>
                @endforeach
                <hr>
                <li>Spedizione: {{ $order['shipping'] }}</li>
                @if ($order['shipping'] > 0)
                  <li>Subtotale: {{ $order['total'] - $order['shipping'] }}</li>     
                @endif
                <li >{{ $order['total'] }}</li>
          </ul>
    </body>
</html>
