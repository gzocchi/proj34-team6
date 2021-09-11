<template>
  <section class="py-5 my-5" v-if="!loading && restaurant">
    <div class="row info">

      <div class="col-12 col-md-8 d-flex justify-content-between m-auto">
        <div>
          <h1>{{ restaurant.name }}</h1>
          <Stars :restaurant = 'restaurant'/>
          <small>Indirizzo: {{ restaurant.address }}</small><br>
          <h5 v-if="restaurant.shipping > 0" class="mt-3 shipping d-inline-block px-3 py-1">
            <i class="fas fa-thumbtack"></i>  Spese di spedizione {{ restaurant.shipping }} €
          </h5>
          <h5 v-else class="mt-3 shipping d-inline-block px-3 py-1"><i class="fas fa-thumbtack"></i>  Spedizione Gratuita!</h5>
          <h6 v-if="restaurant.shipping > 0 && restaurant.shipping_free > 0">
            Spedizione gratuita per ordini superiori a:
            {{ restaurant.shipping_free }} €
          </h6>
        </div>

        <div class="col-12 col-md-4 text-center">
          <img
            :src="'/storage/' + restaurant.bg_image"
            class="card-img-top"
            :alt="restaurant.slug"
          />
          <small><i class="fas fa-biking"></i>  Consegna in 30-45 minuti</small>
        </div>

      </div>
    </div>

    <div></div>

    <div class="row text-center d-flex justify-content-center">
      <DishCard
        :dish="dish"
        v-for="dish in restaurant.dishes"
        :key="dish.id"
        class="col-md-4"
      />
    </div>
  </section>

  <Loader v-else />
</template>

<script>
import Loader from "../components/Loader";
import DishCard from "../components/DishCard";
import Stars from "../components/Stars";

export default {
  name: "Restaurant",
  components: { Loader, DishCard, Stars },
  data() {
    return {
      srvApi: "http://127.0.0.1:8000",
      loading: true,
      restaurant: [],
      categories: [],
      dishes: []
    };
  },
  created() {
    this.getCategories();
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
            this.dishes = res.data.dishes;
          } else {
            this.$router.push({ name: "not-found" });
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getCategories() {
      axios
        .get(`${this.srvApi}/api/categories`)
        .then(res => {
          this.categories = res.data;
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
};
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Advent+Pro:wght@400;700&display=swap');
@import "../../sass/front.scss";

section {
  font-family: 'Advent Pro', sans-serif;

  .info {
    background: white;
  }

  .shipping {
    color: $violet;
    background: rgba(248, 79, 138, 0.1);
    border-radius: 3px;
  }

  .fa-biking {
    color: $azure-dark;
  }
}
</style>
