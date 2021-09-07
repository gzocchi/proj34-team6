<template>
  <section class="text-center py-5 my-5">
    <h1>Restaurants</h1>

    <div class="my-4" v-for="restaurant in restaurants" :key="restaurant.slug">

      <h3>{{ restaurant.name }}</h3>

      <router-link :to="{ name: 'restaurant', params: { slug: restaurant.slug } }"
        >Menu</router-link>

    </div>
  </section>
</template>

<script>
export default {
  name: "Type",
  data() {
    return {
      srvApi: "http://127.0.0.1:8000",
      restaurants: [],
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
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="scss" scoped></style>
