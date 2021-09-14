<div class="card my-5">

      <div class="card-header text-center d-flex justify-content-between">
          <span>-- Info Ordine --</span>
          <div>   
            <p class="text-center">{{ substr($order['created_at'], 0, 10) }}</p>
            <p>{{ substr($order['created_at'], 11, 8) }}</p>
          </div>
      </div>
  
      <div class="card-body">
  
            <ul class="list-group list-group-flush my-4">
                  <li class="list-group-item">Utente: {{ $order['customer_name'] }}</li>
                  <li class="list-group-item">Indirizzp: {{ $order['customer_address'] }}</li>
                  <li class="list-group-item">Numero di telefono: {{ $order['customer_telephone'] }}</li>
                  <li class="list-group-item">Totale: {{ $order['price'] }} &euro;</li>
            </ul>
  
          <div>
  
              <a href="{{ route("admin.home") }}" class="btn my_btn btn-primary">Dashboard</a>
  
          </div>
  
      </div>
  
  </div>