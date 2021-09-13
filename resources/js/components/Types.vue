<template>
  <div class="my_container" v-if="!loading && types">
    <!-- TITOLO E ICONE  -->
    <div class="container-titolo">
      <h2>Non sai cosa scegliere?
      <div class="container-animated-icons mx-5">
        <i class="animated fas fa-hamburger"></i>
        <i class="animated fas fa-pizza-slice"></i>
        <i class="animated fas fa-hotdog"></i>
        <i class="animated fas fa-utensils"></i>
      </div>
    </h2>
    <p class="my-5">Ti diamo noi una mano: scegli la categoria che ti interessa di più</p>
    </div>
    <!-- // TITOLO E ICONE  -->

    <!-- SKEW V-FOR  -->

    <section class="row my-5">
      <div
        class="col-12 col-md-6 col-lg-2 my-3"
        v-for="type in types"
        :key="type.id"
        :style="{ backgroundImage: `url(/storage/${type.image})` }"
      >
        <router-link :to="{ name: 'type', params: { slug: type.slug } }">
          <div class="inner">
            <!-- <img :src="'/storage/' + type.image" :alt="type.name"/> -->
            <div class="layover">
              <h3>{{ type.name }}</h3>
            </div>
          </div>
        </router-link>
      </div>
    </section>

    <!-- bottoni utili solo se si cambia paginazione da 12 a minore  -->
    <button
      v-show="current_page > 1"
      class="btn btn-primary"
      @click="getTypes(current_page - 1)">
      Prev
    </button>
    <button
      v-show="current_page < last_page"
      class="btn btn-info"
      @click="getTypes(current_page + 1)">
          Next
    </button>
    <!-- // SKEW V-FOR  -->

  </div>

  <Loader v-else />
</template>

<script>
import Loader from "./Loader";

export default {
  name: "Types",
  components: { Loader },
  data: function() {
    return {
      srvApi: "http://127.0.0.1:8000",
      types: [],
      loading: true,
      types: [],
      current_page: 1,
      last_page: 1,
    };
  },
  mounted() {
    this.getTypes();
  },
  methods: {
    getTypes: function(page = 1) {
      axios
        .get(`${this.srvApi}/api/types?page=${page}`)
        .then((res) => {
          console.log(res.data);
          this.types = res.data.data;

          this.current_page = res.data.current_page;
          this.last_page = res.data.last_page;
          
          if (this.types.length > 0) {
            this.loading = false;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

.my_container {
  width: 90%;
  margin: 0 auto;  

  div[class*="col-"] {
    position: relative;
    display: flex;
    align-items: center;
    height: 300px;
    overflow: hidden;
    border-radius: 10% 1%;
    border-bottom: 2px solid $teal;
    background-size: cover;

    img {
      max-width: 100%;
      max-height: 100%;
    }
    .layover {
      display: flex;
      justify-content: center;
      align-items: center;
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      background-color: rgba(#d0eb99, 0.7);

      &:hover {
        opacity: 1;
        transition: 0.5s;
        transform: scale(1.5);
      }
    }

    &:hover {
      transform: scale(1.2);
      transition: 0.5s;
      z-index: 2;

      h3 {
        transition: 0.2s ease-in-out;
        color: $purple;
      }
    }
  }

  h2, p {
    font-family: 'Rampart One', cursive;
  }
}
div[class*="col-"] {
  &:first-child{
  background-color: $purple;
  }
  &:nth-child(2){
  background-color: $azure_dark;
  }
  &:nth-child(3){
  background-color: $orange;
  }
  &:nth-child(4){
  background-color: $green;
  }
  &:nth-child(5){
  background-color: $violet;
  }
  &:nth-child(6){
  background-color: $green_dark;
  }
  &:nth-child(7){
  background-color: $cyan;
  }
  &:nth-child(8){
  background-color: $red;
  }
  &:nth-child(9){
  background-color: $yellow;
  }
  &:nth-child(10){
  background-color: $indigo;
  }
  &:nth-child(11){
  background-color: $blue;
  }
  &:nth-child(12){
  background-color: $red;
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
  color: #00CCBC;
}
.fa-hamburger {
  position: relative;
  animation: burger 6s infinite linear;
}
.fa-pizza-slice {
  position: absolute;
  animation: pizza 6s infinite linear;
}
.fa-hotdog {
  position: absolute;
  animation: hotdog 6s infinite linear;
}
.fa-utensils {
  position: absolute;
  animation: utensils 6s infinite linear;
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
// /animated icons
</style>
