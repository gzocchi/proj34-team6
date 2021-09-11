<template>
  <section class="text-center">
    <h1>Restaurants</h1>

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
h1 {
  margin-bottom: 40px;
}
// .row {
//     box-shadow: 0px 0px 5px 0px;
// }
</style>
