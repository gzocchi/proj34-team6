<template>
  <section class="py-5 my-5" v-if="!loading && restaurant">
    <div class="info">
      <h3>Nome: {{ restaurant.name }}</h3>
      <h3>Indirizzo: {{ restaurant.address }}</h3>
      <h3>Spese spedizione: {{ restaurant.shipping }}</h3>
    </div>

    <div class="row text-center">
      <DishCard
        :dish="dish"
        v-for="dish in restaurant.dishes"
        :key="dish.id"
        class="col-md-4"
      />
    </div>
  </section>

  <Loader v-else />
</template>

<script>
import * as cartLs from "cart-localstorage";
import Loader from "../components/Loader";
import DishCard from "../components/DishCard";

export default {
  name: "Restaurant",
  components: { Loader, DishCard },
  data() {
    return {
      cartLs,
      srvApi: "http://127.0.0.1:8000",
      loading: true,
      restaurant: [],
      // cartItem: [],
    };
  },
  mounted() {
    // restaurant slug ---> this.$route.params.slug
    // Chiamata api piatti - ristorante
    this.getDishes(this.$route.params.slug);

    // Carico carrello da storage
    // this.cartItem = this.cartLs.list();
    // Ricarico carrello a ogni cambiamento
    // cartLs.onChange(() => {
    //   console.log('change restaurant');
    //   this.cartItem = this.cartLs.list();
    // });
  },
  methods: {
    getDishes(slug) {
      axios
        .get(`${this.srvApi}/api/restaurant/${slug}`)
        .then((res) => {
          this.restaurant = res.data;
          if (this.restaurant.slug) {
            this.loading = false;
          } else {
            this.$router.push({ name: "not-found" });
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="scss" scoped></style>
