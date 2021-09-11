<template>
  <div class="payment-success">
    <div class="content">
        <img src="/img/logo_yellow.png" alt="logo">
        <h1>Il pagamento è andato a buon fine.</h1>
        <div>Riceverai presto una mail con i dati del tuo ordine.<br>
        Grazie per aver scelto Deliveboo <span class="heart">&#10084;</span>
        </div>
        <router-link :to="{name:'home'}"><button>Vai alla home</button></router-link>
      </div>
        <div class="color"><img class="delivery" src="/img/delivery.png" alt="delivery"></div>
  </div>
</template>

<script>
export default {
   name:"CheckoutSuccess",
}
</script>