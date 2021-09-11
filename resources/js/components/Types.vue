<template>
  <div class="types" v-if="!loading && types">
    <!-- TITOLO E ICONE  -->
    <div class="container-titolo">
      <h2>Non sai cosa scegliere?
      <div class="container-animated-icons">
        <i class="animated fas fa-hamburger"></i>
        <i class="animated fas fa-pizza-slice"></i>
        <i class="animated fas fa-hotdog"></i>
        <i class="animated fas fa-utensils"></i>
      </div>
    </h2>
    <p>Ti diamo noi una mano: scegli la categoria che ti interessa di più</p>
    </div>
    <!-- // TITOLO E ICONE  -->

    <!-- SKEW V-FOR  -->

    <section class="container-skew">
      <div
        class="skewed-card"
        v-for="type in types"
        :key="type.id"
      >
        <router-link :to="{ name: 'type', params: { slug: type.slug } }">
            <div class="section-inner">
              <img
                :src="'/storage/' + type.image"
                :alt="type.name"/>
              <h2>{{ type.name }}</h2>
            </div>
        </router-link>

      </div>
    </section>
    
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
main {
  background-color: lightblue;
}
// general
div.types {
  .type_card {
    text-align: center;
    a {
      display: block;
      padding: 100px 0;
      font-size: 2em;
      text-decoration: none;
      color: #e2004f;
      span {
        padding: 10px;
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.5);
      }
    } 
  }
}
.container-titolo {
  margin-bottom: 90px;
  h2 {
    margin: 10px 0;
  }
  p {
    margin: 20px 0;
    font-weight: 600;
  }
}

// skew types

.container-skew::-webkit-scrollbar {
  display: none;
}
.container-skew{
  overflow-x: auto;
  height: 300px;
  width: 85%;  
  display: flex;
  align-items: center;
  justify-content: center;
  transform: skewX(20deg) scale(1.35);
  margin: 50px auto;
  a:last-child {
    overflow: hidden;
  }
}
.skewed-card {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-grow: 1;
  flex-shrink: 1;
  flex-basis: 0;
  height: 100%;
  transition: 0.5s all ease-in-out;
  overflow: hidden;
  position: relative;
  transform-origin: right;
  border: 1px solid black;
  box-shadow: -10px 0px 5px #00000073;
    img {
    height: 300px;
    }
    .section-inner{
    transform: skewX(-20deg) scale(0.65);
    z-index: 0;
    transform-origin: right;
    }
    &:hover {
    flex-grow: 1.7;
    flex-shrink: 1;
    flex-basis: 0;
    // width: 20%;
    box-shadow: -10px 5px 10px;
    transform-origin: right;
    }
    &:last-child{
      overflow-x: hidden;
    }
}
.skewed-card {
  background-color: orange;
}
// /skew types


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
