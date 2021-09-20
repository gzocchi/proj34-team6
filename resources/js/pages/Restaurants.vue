<template>
  <section class="text-center py-5">
    <div class="container-restaurants-p">
      <h1>Lista dei Ristoranti</h1>
      <p>Scegli quello che preferisci!</p>
    </div>

    <div id="riga"></div>

    <div class="row">
      <!-- originale  -->
      <RestaurantCard
      class="col-12"
        :restaurant="restaurant"
        v-for="restaurant in restaurants"
        :key="restaurant.slug"
      />
    </div>
  </section>
</template>

<script>
import RestaurantCard from "../components/RestaurantCard";

export default {
  name: "Restaurants",
  components: { RestaurantCard},
  data() {
    return {
      srvApi: "http://127.0.0.1:8000",
      restaurants: [],
    };
  },
  mounted() {
    this.getRestaurants();
  },
  methods: {
    getRestaurants() {
      axios
        .get(`${this.srvApi}/api/restaurants`)
        .then((res) => {
          this.restaurants = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

.container-restaurants-p {
  margin-bottom: 10px;
  h1 {
    margin-bottom: 20px;
    color: $azure_dark;
  }
  p {
    color: $purple;
    font-weight: 500;
    font-size: 1.2em;
  }
}
#riga {
  // width: 100%;
  border-bottom: 1px solid $azure;
  margin-bottom: 80px;
}

</style>
