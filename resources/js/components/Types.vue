<template>
  <div class="types" v-if="!loading && types">

    <!-- SKEW V-FOR  -->

    <!-- DISPLAY NONE < 1250  -->
    <div class="container-2000">
      <section class="container-skew container-12">
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
    </div>

    <!-- DISPLAY NONE < 975-> 1250 -->
    <!-- page 1  -->
    <div class="container-1265">
      <section class="container-skew container-6">
        <div
          class="skewed-card"
          v-for="type in typesSix"
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
      <!-- page 2  -->
      <section class="container-skew container-6">
        <div
          class="skewed-card-2"
          v-for="type in typesSixSecond"
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
    </div>

    <!-- DISPLAY >960 & <576 -->
    <div class="container-960">
      <!-- page 1  -->
      <section class="container-skew container-4">
        <div
          class="skewed-card"
          v-for="type in typesFour"
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
      <!-- page 2  -->
      <section class="container-skew container-4">
        <div
          class="skewed-card-2"
          v-for="type in typesFourSecond"
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
      <!-- page 3  -->
      <section class="container-skew container-4">
        <div
          class="skewed-card-3"
          v-for="type in typesFourThird"
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
    </div>
    <!-- // container 976  -->

    <!-- DISPLAY NONE > 576  -->
    <div class="container-576">
    <!-- types PAGINAZIONE da 3  -->
      <section class="container-skew container-3">
        <div
          class="skewed-card"
          v-for="type in typesThree"
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
      <!-- page 2  -->
      <section class="container-skew container-3">
        <div
          class="skewed-card-2"
          v-for="type in typesThreeSecond"
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
      <!-- page 3  -->
      <section class="container-skew container-3">
        <div
          class="skewed-card-3"
          v-for="type in typesThreeThird"
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
      <!-- page 4  -->
      <section class="container-skew container-3">
        <div
          class="skewed-card-4"
          v-for="type in typesThreeFourth"
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
    </div>

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
      // paginazione da 6
      typesSix: [],
      typesSixSecond: [],
      // paginazione da 4 
      typesFour: [],
      typesFourSecond: [],
      typesFourThird: [],
      // paginazione da 3 
      typesThree: [],
      typesThreeSecond: [],
      typesThreeThird: [],
      typesThreeFourth: [],
      loading: true,
      current_page: 1,
      last_page: 1,
    };
  },
  mounted() {
    // pagina singola 
    this.getTypes();
    // paginazione da 6 (2 pagine)
    this.getTypesSix();
    this.getTypesSixSecondPage();
    // paginazione da 4 (3 pagine)
    this.getTypesFour();
    this.getTypesFourSecondPage();
    this.getTypesFourThirdPage();
    // paginazione da 3 (4 pagine)
    this.getTypesThree();
    this.getTypesThreeSecondPage();
    this.getTypesThreeThirdPage();
    this.getTypesThreeFourthPage();
  },
  methods: {

    // paginazione da 12 TIPI per pagina
    getTypes: function(page = 1) {
      axios
        .get(`${this.srvApi}/api/types?page=${page}`)
        .then((res) => {
          // console.log(res.data);
          this.types = res.data.data;

          this.current_page = res.data.current_page;
          this.last_page = res.data.last_page;
          
          if (this.types.length > 0) {
            this.loading = false;
          }
        })
        .catch((err) => {
          // console.log(err);
        });
    },

    //paginazione da 6 TIPI per pagina
    getTypesSix: function(page = 1) {
      axios
        .get(`${this.srvApi}/api/typessix?page=${page}`)
        .then((res) => {
          // console.log(res.data);
          this.typesSix = res.data.data;

          this.current_page = res.data.current_page;
          this.last_page = res.data.last_page;
          
          if (this.typesSix.length > 0) {
            this.loading = false;
          }
        })
        .catch((err) => {
          // console.log(err);
        });
    },
    getTypesSixSecondPage: function(page = 2) {
      axios
        .get(`${this.srvApi}/api/typessix?page=${page}`)
        .then((res) => {
          // console.log(res.data);
          this.typesSixSecond = res.data.data;

          this.current_page = res.data.current_page;
          this.last_page = res.data.last_page;
          
          if (this.typesSixSecond.length > 0) {
            this.loading = false;
          }
        })
        .catch((err) => {
          // console.log(err);
        });
    },

    // paginazione da 4 TIPI per pagina 
    getTypesFour: function(page = 1) {
      axios
        .get(`${this.srvApi}/api/typesfour?page=${page}`)
        .then((res) => {
          // console.log(res.data);
          this.typesFour = res.data.data;

          this.current_page = res.data.current_page;
          this.last_page = res.data.last_page;
          
          if (this.typesFour.length > 0) {
            this.loading = false;
          }
        })
        .catch((err) => {
          // console.log(err);
        });
    },
    getTypesFourSecondPage: function(page = 2) {
      axios
        .get(`${this.srvApi}/api/typesfour?page=${page}`)
        .then((res) => {
          // console.log(res.data);
          this.typesFourSecond = res.data.data;

          this.current_page = res.data.current_page;
          this.last_page = res.data.last_page;
          
          if (this.typesFourSecond.length > 0) {
            this.loading = false;
          }
        })
        .catch((err) => {
          // console.log(err);
        });
    },
    getTypesFourThirdPage: function(page = 3) {
      axios
        .get(`${this.srvApi}/api/typesfour?page=${page}`)
        .then((res) => {
          // console.log(res.data);
          this.typesFourThird = res.data.data;

          this.current_page = res.data.current_page;
          this.last_page = res.data.last_page;
          
          if (this.typesFourThird.length > 0) {
            this.loading = false;
          }
        })
        .catch((err) => {
          // console.log(err);
        });
    },

    // paginazione da 3 TIPI per pagina
    getTypesThree: function(page = 1) {
      axios
        .get(`${this.srvApi}/api/typesthree?page=${page}`)
        .then((res) => {
          // console.log(res.data);
          this.typesThree = res.data.data;

          this.current_page = res.data.current_page;
          this.last_page = res.data.last_page;
          
          if (this.typesThree.length > 0) {
            this.loading = false;
          }
        })
        .catch((err) => {
          // console.log(err);
        });
    },
    getTypesThreeSecondPage: function(page = 2) {
      axios
        .get(`${this.srvApi}/api/typesthree?page=${page}`)
        .then((res) => {
          // console.log(res.data);
          this.typesThreeSecond = res.data.data;

          this.current_page = res.data.current_page;
          this.last_page = res.data.last_page;
          
          if (this.typesThreeSecond.length > 0) {
            this.loading = false;
          }
        })
        .catch((err) => {
          // console.log(err);
        });
    },
    getTypesThreeThirdPage: function(page = 3) {
      axios
        .get(`${this.srvApi}/api/typesthree?page=${page}`)
        .then((res) => {
          // console.log(res.data);
          this.typesThreeThird = res.data.data;

          this.current_page = res.data.current_page;
          this.last_page = res.data.last_page;
          
          if (this.typesThreeThird.length > 0) {
            this.loading = false;
          }
        })
            
        .catch((err) => {
          // console.log(err);
        });
    },
    getTypesThreeFourthPage: function(page = 4) {
      axios
        .get(`${this.srvApi}/api/typesthree?page=${page}`)
        .then((res) => {
          // console.log(res.data);
          this.typesThreeFourth = res.data.data;

          this.current_page = res.data.current_page;
          this.last_page = res.data.last_page;
          
          if (this.typesThreeFourth.length > 0) {
            this.loading = false;
          }
        })
        .catch((err) => {
          // console.log(err);
        });
    },

  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

main {
  background-color: lightblue;
}
// general
div.types {
  padding: 3em 0;
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

// skew types

.container-skew::-webkit-scrollbar {
  display: none;
}
.container-skew{
  // overflow-x: auto;
  height: 200px;
  width: 75%;  
  display: flex;
  align-items: center;
  justify-content: center;
  transform: skewX(20deg) scale(1.35);
  margin: 40px auto 80px;
  border-radius: 5px;
  a:last-child {
    overflow: hidden;
  }
}
.skewed-card,
.skewed-card-2,
.skewed-card-3,
.skewed-card-4 {
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
  left: -10px;
  transform-origin: right;
  box-shadow: -10px 0px 5px #00000073;
    .section-inner{
    transform: skewX(-20deg) scale(0.65);
    z-index: 0;
    transform-origin: right;
    position: relative;
    left: -10px;
    }
    &:hover {
    flex-grow: 1.7;
    flex-shrink: 1;
    flex-basis: 0;
    transform: scale(1.05);
    box-shadow: -10px 5px 10px;
    transform-origin: right;
    }
    &:last-child{
      overflow-x: hidden;
    }
    a {
      text-decoration: none;
      color: white;
      img {
        height: 120px;
      }
      h2 {
        transition: 0.2s ease-in-out;
      }
      &:hover h2 {
        color: white;
      }
    }
}

// backgrounds cards 
.skewed-card {
  border-radius: 5px;
  &:first-child{
  background-color: $purple;
  }
  &:nth-child(2){
  background-color: rgb(209, 61, 2);
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
  background-color: #21A500;
  }
  &:nth-child(7){
  background-color: $cyan;
  }
  &:nth-child(8){
  background-color: $red;
  }
  &:nth-child(9){
  background-color: #2e353b;
  }
  &:nth-child(10){
  background-color: #2C2948;
  }
  &:nth-child(11){
  background-color: $blue;
  }
  &:nth-child(12){
  background-color: #8ff132;
  }
}



//media query
// 1250
@media screen and (min-width: 1265px) {
  .container-1265,
  .container-960,
  .container-576 {
    display: none;
  }
  .container-2000 {
    display: inline;
  }
}

@media screen and (min-width: 960px) and (max-width: 1264px) {
  // paginazione da 12
  .container-2000,
  .container-960,
  .container-576 {
    display: none;
  }
  .skewed-card-2 {
    &:nth-child(1){
    background-color: $cyan;
    }
    &:nth-child(2){
    background-color: $red;
    }
    &:nth-child(3){
    background-color: #2e353b;
    }
    &:nth-child(4){
    background-color: #2C2948;
    }
    &:nth-child(5){
    background-color: $blue;
    }
    &:nth-child(6){
    background-color: #8ff132;
    }
  }
  
}

@media only screen and (max-width: 959px) {
  // paginazione da 4
  .container-2000,
  .container-1265,
  .container-576 {
      display: none;
  }
  .skewed-card-2 {
    &:nth-child(1){
    background-color: $violet;
    }
    &:nth-child(2){
    background-color: #21A500;
    }
    &:nth-child(3){
    background-color: $cyan;
    }
    &:nth-child(4){
    background-color: $red;
    }
  }
  .skewed-card-3 {
    &:nth-child(1){
    background-color: #2e353b;
    }
    &:nth-child(2){
    background-color: #2C2948;
    }
    &:nth-child(3){
    background-color: $blue;
    }
    &:nth-child(4){
    background-color: #8ff132;
    }
  }
}

@media only screen and (max-width: 576px) {
  // paginazione da 4
  .container-960 {
    display: none;
  }
  .container-576 {
    display: inline;
  }
  .skewed-card-2 {
    &:nth-child(1){
    background-color: $green;
    }
    &:nth-child(2){
    background-color: $violet;
    }
    &:nth-child(3){
    background-color: #21A500;
    }
  }
  .skewed-card-3 {
    &:nth-child(1){
    background-color: $cyan;
    }
    &:nth-child(2){
    background-color: $red;
    }
    &:nth-child(3){
    background-color: #2e353b;
    }
  }
  .skewed-card-4 {
    &:nth-child(1){
    background-color: #2C2948;
    }
    &:nth-child(2){
    background-color: $blue;
    }
    &:nth-child(3){
    background-color: #8ff132;
    }
  }
}

</style>
