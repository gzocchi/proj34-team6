<template>

  <!-- SEZIONE RISTORANTE SINGOLO  -->
  <section class="py-5 my-5" v-if="!loading && restaurant">

    <div class="row info">
      
      <div class="col-12 col-md-4">
        <img
          :src="'/storage/' + restaurant.bg_image"
          class="card-img-top"
          :alt="restaurant.slug"
        />
      </div>
      <div class="col-12 col-md-8">
        <h1 class="font-weight-bold">{{ restaurant.name }}</h1>
        <h4>{{ restaurant.address }}</h4>
        <span class="font-italic d-block" v-if="restaurant.shipping > 0">
          Spese di spedizione {{ restaurant.shipping }} €
        </span>
        <span class="font-italic d-block" v-else>Spedizione Gratuita!</span>
        <span class="font-italic d-block" v-if="restaurant.shipping > 0 && restaurant.shipping_free > 0">
          Spedizione gratuita per ordini superiori a:
          {{ restaurant.shipping_free }} €
        </span>
        <i
            v-for="i in 5"
            :key="i"
            :class="i <= starCount() ? 'fas fa-star' : 'far fa-star'"
        ></i>
      </div>

    </div>

    <div class="row text-center">
      <DishCard
        :dish="dish"
        v-for="dish in restaurant.dishes"
        :key="dish.id"
        class="col-sm-6 col-md-4 col-xl-3"
      />
    </div>

  </section>

  <Loader v-else />
</template>

<script>
import Loader from "../components/Loader";
import DishCard from "../components/DishCard";

export default {
  name: "Restaurant",
  components: { Loader, DishCard },
  data() {
    return {
      srvApi: "http://127.0.0.1:8000",
      loading: true,
      restaurant: [],
    };
  },
  mounted() {
    // restaurant slug ---> this.$route.params.slug
    // Chiamata api piatti - ristorante
    this.getDishes(this.$route.params.slug);
  },
  methods: {
    getDishes(slug) {
      axios
        .get(`${this.srvApi}/api/restaurant/${slug}`)
        .then((res) => {
          this.restaurant = res.data;
          if (this.restaurant.slug) {
            this.loading = false;
          } else {
            this.$router.push({ name: "not-found" });
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    starCount: function() {
      return Math.round(this.restaurant.vote);
    }
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

.fas.fa-star {
    color: $red;
  }
h1{
  color: $violet;
}
</style>
