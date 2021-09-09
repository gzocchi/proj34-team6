<template>
  <section class="text-center py-5 my-5">
    <h1>Restaurants</h1>

    <div class="row">
      <RestaurantCard
        class="col-md-4"
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
  components: { RestaurantCard },
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

<style lang="scss" scoped></style>
