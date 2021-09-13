<template>
  <div class="jumbotron jumbotron-fluid" v-if="$route.name === 'home'">
    <div class="container">
      <div class="row">
        <div class="text col-12 col-md-6">
          <h1 class="display-4">I piatti che ami, a domicilio.</h1>
          <hr class="my-4" />
          <p class="lead">#aCasaTuaConDeliveBoo</p>
          <router-link :to="{ name: 'restaurants' }" class="btn btn-lg"
            >Ristoranti</router-link
          >
        </div>
        <div class="col-12 col-md-6 text-center">
          <img class="img-fluid" src="images/jumbotron.svg" alt="DeliveBoo" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Jumbotron",
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

.jumbotron {
  // height: 40vh;
  // max-height: 500px;
  background-color: $green;
  background-image: -webkit-linear-gradient(100deg, $green 50%, $azure 50%);
  color: $purple;
  border-radius: 10% 1%;

  h1 {
    font-weight: 700;
  }

  hr {
    border-top: 1px solid rgba($purple, 0.5);
  }

  .btn {
    color: #fff;
    background-color: $green_dark;
    border-color: $green_dark;
  }

  img {
    max-height: 400px;
  }
}
</style>
