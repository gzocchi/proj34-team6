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
                  <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Utente:</p> {{ $order['customer_name'] }}</li>
                  <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Indirizzo:</p> {{ $order['customer_address'] }}</li>
                  <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Numero di telefono:</p> {{ $order['customer_telephone'] }}</li>
                  <li class="list-group-item"><p class="text-uppercase font-weight-bold d-inline-block">Totale:</p> {{ $order['price'] }} &euro;</li>
            </ul>
  
          <div class="text-center">
  
              <a href="{{ route("admin.home") }}" class="text-uppercase btn my_btn btn-primary font-weight-bold">Dashboard</a>
  
          </div>
  
      </div>
  
  </div>