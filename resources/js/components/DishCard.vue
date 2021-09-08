<template>
  <div>
    <div class="card-deck mt-4 mb-4 text-center">
      <div class="card mb-4 shadow-sm">
        <div class="card-header">
          <h4 class="my-0 font-weight-normal">{{ dish.name }}</h4>
        </div>
        <div class="card-body">
          <h1 class="card-title pricing-card-title">${{ dish.price }}</h1>

          <button
            type="button"
            class="btn btn-block btn-outline-primary"
            @click="addDish(dish)"
          >
            Add to Cart
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import * as cartLs from "cart-localstorage";

export default {
  name: "DishCard",
  props: {
    dish: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      cartLs,
    };
  },
  methods: {
    addDish(dish) {
      if (this.cartLs.list().length > 0) {
        if (dish.restaurant_id == this.cartLs.list()[0].restaurant_id) {
          cartLs.add(dish);
        } else {
          cartLs.destroy();
          cartLs.add(dish);
        }
      } else {
        cartLs.add(dish);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
</style>
