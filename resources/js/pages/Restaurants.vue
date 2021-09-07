<template>
  <section class="text-center py-5 my-5">
    <h1>Restaurants</h1>

    <div v-for="restaurant in restaurants" :key="restaurant.slug">
      <h3>{{ restaurant.name }}</h3>
      <router-link :to="{ name: 'dishes', params: { slug: restaurant.slug } }"
        >Menu</router-link
      >
    </div>
  </section>
</template>

<script>
export default {
  name: "Restaurants",
  data() {
    return {
      srvApi: "http://127.0.0.1:8000",
      restaurants: [],
    };
  },
  mounted() {
    this.getPost();
  },
  methods: {
    getPost() {
      axios
        .get(`${this.srvApi}/api/restaurants`)
        .then((res) => {
          this.restaurants = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="scss" scoped></style>
