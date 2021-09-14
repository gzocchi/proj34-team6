<template>
  <div>
    <Header :totalQuantity="total" :cart="cartItem" />

    <Jumbotron />

    <main class="container">
      <router-view :cart="cartItem"></router-view>
    </main>

    <Footer />
  </div>
</template>

<script>
import * as cartLs from "cart-localstorage";
import Header from "./components/Header";
import Jumbotron from "./components/Jumbotron";
import Footer from "./components/Footer";

export default {
  name: "App",
  components: {
    Header,
    Jumbotron,
    Footer,
  },
  data() {
    return {
      cartLs,
      cartItem: [],
      total: 0,
    };
  },
  mounted() {
    // Carico carrello da storage
    this.cartItem = this.cartLs.list();

    this.totalQuantity();

    // Ricarico carrello a ogni cambiamento
    this.cartLs.onChange(() => {
      this.cartItem = this.cartLs.list();
      this.totalQuantity();
    });
  },
  methods: {
    totalQuantity() {
      this.total = 0;
      this.cartLs.list().forEach((item) => {
        this.total += item.quantity;
      });
    },
  },
};
</script>

<style lang="scss">
@import "../sass/front";

body {

  .swal-modal {
    .swal-icon--warning__body,
    .swal-icon--warning__dot {
      background-color: $orange;
    }
    .swal-button.swal-button--cancel {
      background-color: $azure;
    }
    .swal-button.swal-button--confirm {
      background-color: $red;
    }
  }
}
</style>