<template>
  <div class="checkouterror">
    <div class="content">
      <i class="fas fa-times"></i>
      <h1>Ops, qualcosa è andato storto...</h1>
      <div>Siamo spiacenti, il pagamento non è andato a buon fine. <br>
        Riprova con un altro metodo di pagamento
      </div>
      <router-link :to="{name:'home'}"><button class="btn my_btn btn-primary my-3">Torna alla home</button></router-link>
    </div>
  </div>
</template>

<script>
export default {
   name:"PaymentError",
}
</script>

<style lang='scss' scoped>

@import "../../sass/front";

i {
  font-size: 40px;
  color: $red;
  padding: 10px;
}

h1 {
  text-align: center;
  margin-bottom: 10px;
  color: $red;
}

div {
  text-align: center;
}

</style>