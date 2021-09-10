<template>
  <div class="container-fluid" v-if="$route.name === 'home'">
    <div class="jumbotron">
      <!-- <img src="/images/jumbotron.svg" alt="DeliveBoo"> -->
    </div>
  </div>
</template>

<script>
export default {
  name: "Jumbotron",
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

.jumbotron {
  height: 40vh;
  min-height: 500px;
  background-color: $green;
  background-image: -webkit-linear-gradient(100deg, $green 50%, $azure 50%);
}
</style>
