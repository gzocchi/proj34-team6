<template>
  <router-link
        :to="{ name: 'restaurant', params: { slug: restaurant.slug } }"
        >
  <div class="card row">
    <!-- parte img  -->
    <div class="container-img col-12 col-md-4">
      <img
        :src="'/storage/' + restaurant.bg_image"
        class="card-img-top"
        :alt="restaurant.slug"/>
    </div>
    <!-- parte testo  -->
    <div class="card-body col-12 col-md-8">
      <!-- testo card di sinistra  -->
      <div class="container-text-left">
        <!-- container titolo e indirizzo  -->
        <div class="title-nd-small">
          <h1 class="card-title">{{ restaurant.name }}</h1>
          <small>{{ restaurant.address }}</small>
        </div>
        <!-- container voto e stelle  -->
        <div class="container-vote">
          <h5>Vote: {{ restaurant.vote }}</h5>
          <i
            v-for="i in 5"
            :key="i"
            :class="i <= starCount() ? 'fas fa-star' : 'far fa-star'"
        ></i>
        </div>
      </div>

      <div class="container-text-right">
        <h4 v-if="restaurant.shipping == 0" class="badge badge-danger">Consegna gratuita!</h4>
        <h4 v-else><i class="far fa-money-bill-alt"></i> Consegna: {{ restaurant.shipping }}€</h4>
      </div>
      
    </div>
  </div>
  </router-link>

</template>

<script>
export default {
  name: "RestaurantCard",
  props: {
    restaurant: {
      type: Object,
      required: true,
    },
  },
  methods: {
    starCount: function() {
            return Math.round(this.restaurant.vote);
        }
  }
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

// bootstrap riscritto
.col, .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col-auto, .col-lg, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-auto, .col-md, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md-auto, .col-sm, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-auto {
    width: 100%;
    padding: 5px;
}
.row a:hover {
  color: black;
  text-decoration: none;
}

// card
.card {
  flex-direction: row;
  transition: 0.5s;
  margin: 2px 0;
  padding: 10px;
  border: none;
  box-shadow: 0px 0px 5px $azure_dark;
  color: black;
  &:hover {
    transform: scale(1.01);
    box-shadow: 0px 0px 10px 0px;
    z-index: 1;
  }
  &:hover h1 {
    // color: rgb(190, 124, 0);
    color: $orange;
  }
  a:hover {
    text-decoration: none;
  } 
}
a {
  color: black;
  &:hover {
    text-decoration: none;
  } 
}
.card-body {
  display: flex;
  justify-content: space-between;
}
.container-img {
  width: 350px;
  img {
    height: 180px;
    width: 100%;
  }
}

.container-text-left {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  text-align: left;
  height: 100%;
  h1,
  small,
  h5 {
    line-height: 1.1;
    transition: 1s;
    margin: 0;
  }
  .fas.fa-star {
    color: rgb(212, 0, 0);
  }
}
.container-text-right {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  text-align: left;
  height: 100%;
  justify-content: flex-end;
  h3,
  h4 {
    font-size: 1rem;
    margin: 0;
  }
}
</style>