<template>
  <section>
    <div>
      <img id="img-title" src="/images/logo-DeliveBoo.svg" height="30" alt="DeliveBoo" />
      <h1 class="text-center">Hai fame? Fai un giro-virtuale nei nostri ristoranti!</h1>
    </div>
    

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
@import "../../sass/front";

#img-title {
  animation: hei 4s ease;
  animation-iteration-count: 2;
}
@keyframes hei {
  30% { transform: scale(1.2); }
  40%, 60% { transform: rotate(-20deg) scale(1.2); }
  50% { transform: rotate(20deg) scale(1.2); }
  70% { transform: rotate(0deg) scale(1.2); }
  100% { transform: scale(1); }
}

h1 {
  margin: 1em 0 3em;
}
</style>
