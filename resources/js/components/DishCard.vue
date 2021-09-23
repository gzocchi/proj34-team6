<template>
  <div class="d-flex align-items-stretch">
    <div
      class="card-deck mt-4 mb-4 text-center d-flex justify-content-between"
      :class="{ disabled_dish: !dish.visible }"
    >
      <div class="card mb-4 shadow-sm">
        <div class="card-header">
          <img
            class="img-fluid rounded"
            :src="'/storage/' + dish.img"
            :alt="dish.name"
          />
        </div>

        <div class="card-body d-flex flex-column justify-content-between align-items-center">
          <h4 class="m-0 card-title font-weight-normal">{{ dish.name }}</h4>
          <span class="d-block font-weight-bold">{{ dish.price }}€</span>
          <p v-if="dish.description" class="text-left p-3">
            {{ dish.description }}
          </p>

          <button
            v-if="!dish.visible ? '' : 'disabled'"
            type="button"
            class="btn my_btn btn-primary mt-2"
            @click="addDish(dish)"
          >
            Aggiungi al Carrello
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
          swal({
            title: "Sei sicuro?",
            text: "Con l'aggiunta di questo piatto il carrello verrà eliminato!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
            if (willDelete) {
              swal("Il nuovo prodotto è stato aggiunto al carrello", {
                icon: "success",
              });
            } else {
              swal("Il tuo carrello è al sicuro!");
            }
            if (willDelete) {
              cartLs.destroy();
              cartLs.add(dish);
            }
          });
        }
      } else {
        cartLs.add(dish);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

.disabled_dish{
  & > * {
  opacity: 0.5;
  filter: grayscale(1);
  }
  .card-body > span {
    text-decoration: line-through;
  }
}

.card-header {
  background-color: $pink;
  img {
    max-height: 100px;
  }
}

.card-body {
  h4 {
    color: $green_dark;
  }
  span {
    color: $purple;
    font-size: 2em;
  }

  p {
    background-color: $pink;
    border-radius: 5px;
  }
}
</style>
