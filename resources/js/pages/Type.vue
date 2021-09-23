<template>
  <section class="text-center py-5" v-if="!loading && restaurants">

    <!-- Tipo della pagina visualizzata -->
    <h1 class="pb-5">{{ restaurants.length }} Ristoranti visualizzati corrispondono a <span>"{{ $route.params.slug.charAt(0).toUpperCase() + $route.params.slug.slice(1) }}"</span></h1>

    <div id="riga"></div>

    <div class="row">
      <RestaurantCard
      class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2"
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
          this.$router.push({ name: "not-found" });
        });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

#riga {
  // width: 100%;
  border-bottom: 1px solid $azure;
  margin-bottom: 80px;
}
h1 {
  color: $azure_dark;
  span {
    color: $purple;
  }
}

</style>
