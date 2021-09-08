<template>
  <section class="text-center py-5 my-5" v-if="!loading && restaurants">
    <div class="row">
      <RestaurantCard
      class="col-md-4"
        :restaurant="restaurant"
        v-for="restaurant in restaurants"
        :key="restaurant.slug"
      />
    </div>
  </section>
  <Loader v-else />
</template>

<script>
import Loader from "../components/Loader";
import RestaurantCard from "../components/RestaurantCard";

export default {
  name: "Type",
  components: { Loader, RestaurantCard },
  data() {
    return {
      srvApi: "http://127.0.0.1:8000",
      restaurants: [],
      loading: true,
    };
  },
  mounted() {
    this.getRestaurants(this.$route.params.slug);
  },
  methods: {
    getRestaurants(slug) {
      axios
        .get(`${this.srvApi}/api/type/${slug}`)
        .then((res) => {
          this.restaurants = res.data.restaurants;
          if (this.restaurants.length > 0) {
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
