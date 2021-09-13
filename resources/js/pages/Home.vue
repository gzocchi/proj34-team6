<template>
  <section>
    <h1 class="text-center">Da Best DeliveBoo</h1>

    <!-- scleta per tipologie di ristoranti  -->
    <Types />

    <!-- card info generiche  -->
    <HomeCards />

  </section>
</template>

<script>
import Types from "../components/Types";
import HomeCards from "../components/HomeCards";

export default {
  name: "Home",
  components: {
    Types,
    HomeCards
  },
};
</script>

<style lang="scss" scoped>
h1 {
  margin: 1em 0 3em;
}
</style>
