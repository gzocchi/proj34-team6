<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Ordine in preparazione</title>

        <style>
            ul {
                list-style-type: none;
                padding: 5px 5px 20px;
            }
            span {
                font: italic;
            }
            table {
                border-collapse: collapse;
            }
            thead {
                border-bottom: 1px solid black;
            }
            tfoot {
                border-top: 1px solid black;
            }            
        </style>
    </head>
    <body>
        
        <img src="http://127.0.0.1:8000/images/logo-DeliveBoo.svg" height="50px"/>

        <h2>Buongiorno <span>{{ $order['customer_name'] }}</span>, il tuo ordine n° 0233249 è in preparazione.</h2>
        <h3>L'arrivo è previsto alle ore: 19:30 presso <span>{{ $order['customer_address'] }}</span>.</h3>
        <h5>Grazie per aver ordinato con DeliveBoo!</h5>

            <ul class="list">
                <li><strong>- Ordine effettuato presso:</strong> {{ $order['restaurant_name'] }}</li>
                <li><strong>- Indirizzo ristorante:</strong> {{ $order['restaurant_address'] }}</li>
                <li><strong>- N° telefono ristorante</strong> {{ $order['restaurant_telephone'] }}</li>                
                <li><strong>- Per ogni evenienza verrai contatta al numero: </strong>{{ $order['customer_telephone'] }}</li>
            </ul>

                <h3>Riepilogo dell'ordine</h3>
                <table>
                    <thead>
                        <tr style="text-align: center; font: bold uppercase;">
                            <th>Prodotto</th>
                            <th>Quantità</th>
                            <th>Prezzo</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($order['all_dishes'] as $dish)
                        <tr>
                            <td>{{ $dish['name'] }}</td>
                            <td style="text-align: center">x{{ $dish['quantity'] }}</td>
                            <td style="text-align: center">{{ $dish['price'] }}€</td>
                        </tr>
                        {{-- <li>{{ $dish['quantity'] }} x {{ $dish['name'] }} - {{ $dish['price'] }} &euro;</li> --}}
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Spedizione: {{ $order['shipping'] }}€</td>
                            <td>
                                @if ($order['shipping'] > 0)
                                    Subtotale: {{ $order['total'] - $order['shipping'] }}€   
                                @endif
                            </td>
                            <td>Totale:{{ $order['total'] }}€</td>
                        </tr>
                    </tfoot>
                  </table>


                {{-- <li><strong>Riepilogo ordine:</strong></li>
                @foreach ($order['all_dishes'] as $dish)
                    <tr>
                        <td>{{ $dish['name'] }}</td>
                        <td>x{{ $dish['quantity'] }}</td>
                        <td>{{ $dish['price'] }}€</td>
                    </tr>
                    <li>{{ $dish['quantity'] }} x {{ $dish['name'] }} - {{ $dish['price'] }} &euro;</li>
                @endforeach
                
                <li>Spedizione: {{ $order['shipping'] }}€</li>
                @if ($order['shipping'] > 0)
                  <li>Subtotale: {{ $order['total'] - $order['shipping'] }}€</li>     
                @endif
                <li >Importo totale:{{ $order['total'] }}€</li> --}}
                
    </body>
</html>
