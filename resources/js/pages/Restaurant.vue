<template>
  <section class="py-5 my-5" v-if="!loading && restaurant">
    <div class="row info">
      <div class="col-12 col-md-4">
        <img
          :src="'/storage/' + restaurant.bg_image"
          class="card-img-top"
          :alt="restaurant.slug"
        />
      </div>

      <div class="col-12 col-md-8">
        <h1>{{ restaurant.name }}</h1>
        <Stars :restaurant = 'restaurant'/>
        <h3>Indirizzo: {{ restaurant.address }}</h3>
        <h5 v-if="restaurant.shipping > 0">
          Spese di spedizione {{ restaurant.shipping }} €
        </h5>
        <h5 v-else>Spedizione Gratuita!</h5>
        <h6 v-if="restaurant.shipping > 0 && restaurant.shipping_free > 0">
          Spedizione gratuita per ordini superiori a:
          {{ restaurant.shipping_free }} €
        </h6>
      </div>
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
import Loader from "../components/Loader";
import DishCard from "../components/DishCard";
import Stars from "../components/Stars";

export default {
  name: "Restaurant",
  components: { Loader, DishCard, Stars },
  data() {
    return {
      srvApi: "http://127.0.0.1:8000",
      loading: true,
      restaurant: [],
    };
  },
  mounted() {
    // restaurant slug ---> this.$route.params.slug
    // Chiamata api piatti - ristorante
    this.getDishes(this.$route.params.slug);
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
