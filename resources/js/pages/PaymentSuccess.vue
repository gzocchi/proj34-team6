<template>
  <div class="payment-success">
    <div class="content">
        <i class="fas fa-check"></i>
        <h1>Il pagamento è andato a buon fine.</h1>
        <span>Grazie per aver scelto Deliveboo!!</span>
        <router-link :to="{name:'home'}"> <br> <button>Torna alla home</button></router-link>
      </div>
  </div>
</template>

<script>
export default {
   name:"PaymentSuccess",
}
</script>

<style lang='scss' scoped>

@import "../../sass/front";

i {
  font-size: 40px;
  color: $green;
  padding: 10px;
}

h1 {
  text-align: center;
  margin-bottom: 10px;
  color: $green;
}

div {
  text-align: center;
}

button {
  margin-top: 20px;
  background-color: $azure;
  color: black;
  padding: 5px;
  border-radius: 30px;
  margin-bottom: 20px;
}

</style>