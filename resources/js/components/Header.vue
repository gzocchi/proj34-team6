<template>
  <header class="container">
    <nav class="my_nav navbar navbar-expand-lg navbar-light bg-white">
      <router-link :to="{ name: 'home' }" class="navbar-brand">
        <img src="/images/logo.svg" height="30" alt="DeliveBoo" />
      </router-link>

      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <!-- <li class="nav-item">
            <router-link :to="{ name: 'home' }" class="nav-link"
              >Home</router-link
            >
          </li> -->
          <li class="nav-item">
            <router-link :to="{ name: 'restaurants' }" class="nav-link"
              >Ristoranti</router-link
            >
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'cart' }" class="nav-link"
              >Carrello<span v-if="totalQuantity" class="badge ml-1">{{
                totalQuantity
              }}</span></router-link
            >
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/login">Registrati o accedi</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- <Jumbotron /> -->
  </header>
</template>

<script>
// import Jumbotron from "./Jumbotron";

export default {
  name: "Header",
  // components: { Jumbotron },
  props: {
    totalQuantity: {
      type: Number,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

.my_nav .navbar-nav .nav-link.active {
  color: $azure;
}

span.badge {
  background-color: $violet;
  color: white;
  line-height: 1.5;
  vertical-align: middle;
}
</style>
