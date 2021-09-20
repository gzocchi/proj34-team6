<template>
  <!-- SEZIONE RISTORANTE SINGOLO  -->
  <section class="pt-5" v-if="!loading && restaurant">

    <div class="row info mb-4">
      <div class="col-12 col-md-4">
        <img
          :src="'/storage/' + restaurant.bg_image"
          class="card-img-top rounded"
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
        <span
          class="font-italic d-block"
          v-if="restaurant.shipping > 0 && restaurant.shipping_free > 0"
        >
          Spedizione gratuita per ordini superiori a:
          {{ restaurant.shipping_free }} €
        </span>
        <Stars :restaurant="restaurant" />
      </div>
    </div>

    <div
      :id="key"
      class="row text-cente"
      v-for="(category, key) in dishes"
      :key="key"
    >
      <div class="col-12 text-left category_title">
        <span class="badge pl-3 py-2 d-block text-left">{{ key }}</span>
      </div>

      <DishCard
        :dish="dish"
        v-for="dish in category"
        :key="dish.id"
        class="col-sm-6 col-md-4 col-xl-3"
      />
    </div>

    <!-- <div class="row text-center">
      <DishCard
        :dish="dish"
        v-for="dish in restaurant.dishes"
        :key="dish.id"
        class="col-sm-6 col-md-4 col-xl-3"
      />
    </div> -->
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
      dishes: {},
    };
  },
  mounted() {
    // restaurant slug ---> this.$route.params.slug
    // Chiamata api piatti - ristorante
    this.getCategories();
    // this.getDishes(this.$route.params.slug);
  },
  methods: {
    getDishes(slug) {
      axios
        .get(`${this.srvApi}/api/restaurant/${slug}`)
        .then((res) => {
          this.restaurant = res.data;
          if (this.restaurant.slug) {
            this.restaurant.dishes.forEach((dish) => {
              let category = dish.category_id;
              let categoryName = "";
              this.categories.forEach((cat) => {
                cat.id == category ? (categoryName = cat.name) : "";
              });

              if (this.dishes[categoryName]) {
                this.dishes[categoryName].push(dish);
              } else {
                this.dishes[categoryName] = [dish];
              }
            });

            this.loading = false;
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
        .then((res) => {
          this.categories = res.data;
          this.getDishes(this.$route.params.slug);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    starCount: function () {
      return Math.round(this.restaurant.vote);
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

.fas.fa-star {
  color: $red;
}
h1 {
  color: $violet;
}

.category_title{
  span{
    color: white;
    background-color: $violet;
  }
}
</style>
