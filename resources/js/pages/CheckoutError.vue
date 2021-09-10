<template>
  <div class="checkouterror">
    <div class="content">
      <h1>Qualcosa è andato storto</h1>
      <div>Siamo spiacenti, il pagamento non è andato a buon fine. <br>
        Riprova con un altro metodo di pagamento
      </div>
      <router-link :to="{name:'home'}"><button>Vai alla home</button></router-link>
    </div>
  </div>
</template>

<script>
export default {
   name:"CheckoutError",
}
</script>

<style></style>