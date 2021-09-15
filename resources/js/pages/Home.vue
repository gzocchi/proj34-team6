<template>
  <section>

    <!-- TITOLO E ICONE  -->
    <div class="container-titolo">
      <img id="img-title" src="/images/logo-DeliveBoo.svg" height="30" alt="DeliveBoo" />
      <h1 class="text-center">Non sai cosa scegliere?
      <div class="container-animated-icons">
        <i class="animated fas fa-hamburger"></i>
        <i class="animated fas fa-pizza-slice"></i>
        <i class="animated fas fa-hotdog"></i>
        <i class="animated fas fa-utensils"></i>
      </div>
    </h1>
    <p class="text-center">Ti diamo noi una mano: scegli la categoria che ti interessa di più!</p>
    </div>
    <!-- // TITOLO E ICONE  -->
    

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
.container-titolo {
  margin: 2em 0 4em;
  padding: 2em 0;
  h1 {
    margin: 1em 0;
  }
  p {
    margin: 1em 0;
    font-weight: 600;
  }
}
  


// animated icons
.container-animated-icons {
  position: relative;
  top: -30px;
  display: inline;
  margin-left: 10px;
}
.animated {
  width: 10px;
  height: 10px;
  color: $indigo;
}
.fa-hamburger {
  position: relative;
  animation: burger 8s infinite linear;
}
.fa-pizza-slice {
  position: absolute;
  animation: pizza 8s infinite linear;
}
.fa-hotdog {
  position: absolute;
  animation: hotdog 8s infinite linear;
}
.fa-utensils {
  position: absolute;
  animation: utensils 8s infinite linear;
}
@keyframes burger {
  0%   {left:0px; top:0px;}
  25%  {left:70px; top:0px;}
  50%  {left:70px; top:50px;}
  75%  {left:0px; top:50px;}
  100% {left:0px; top:0px;}
}
@keyframes pizza {
  0%  {left:70px; top:0px;}
  25%  {left:70px; top:50px;}
  50%  {left:0px; top:50px;}
  75% {left:0px; top:0px;}
  100% {left:70px; top:0px;}
}
@keyframes hotdog {
  0%  {left:70px; top:50px;}
  25%  {left:0px; top:50px;}
  50% {left:0px; top:0px;}
  75% {left:70px; top:0px;}
  100% {left:70px; top:50px;}
}
@keyframes utensils {
  0%  {left:0px; top:50px;}
  25% {left:0px; top:0px;}
  50% {left:70px; top:0px;}
  75% {left:70px; top:50px;}
  100%  {left:0px; top:50px;}
}

// animazione deliveboo 
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
</style>
