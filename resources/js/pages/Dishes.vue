<template>
  <section class="text-center py-5 my-5">
    <div class="container">
      <div class="card-deck mt-4 mb-4 text-center">
        <div class="card mb-4 shadow-sm" v-for="dish in dishes" :key="dish.id">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{ dish.name }}</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">${{ dish.price }}</h1>

            <button
              type="button"
              class="btn btn-block btn-outline-primary"
              @click="cartLs.add(dish)"
            >
              Add to Cart
            </button>

            <button
              type="button"
              class="btn btn-sm btn-outline-primary"
              @click="cartLs.quantity(dish.id, 1)"
            >
              +
            </button>

            <button
              type="button"
              class="btn btn-sm btn-outline-primary"
              @click="cartLs.quantity(dish.id, -1)"
            >
              -
            </button>

            <button class="btn btn-primary" @click="cartLs.remove(dish.id)">
              Delete
            </button>
          </div>
        </div>
      </div>

      <div class="card mb-4 shadow-sm">
        <div class="card-header">
          <h2>Cart</h2>
        </div>
        <div class="card-body">
          <table class="table">
            <tbody class="cart">
              <tr v-for="item in cartItem" :key="item.id">
                <td>#{{ item.id }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.quantity }}</td>
                <td style="width: 60px">
                  <button
                    type="button"
                    class="btn btn-block btn-sm btn-outline-primary"
                    @click="cartLs.quantity(item.id, 1)"
                  >
                    +
                  </button>
                </td>
                <td style="width: 60px">
                  <button
                    type="button"
                    class="btn btn-block btn-sm btn-outline-primary"
                    @click="cartLs.quantity(item.id, -1)"
                  >
                    -
                  </button>
                </td>
                <td class="text-right">€{{ item.price }}</td>
                <td class="text-right">
                  <button
                    class="btn btn-primary"
                    @click="cartLs.remove(item.id)"
                  >
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <td colspan="5"></td>
              <td class="text-right">
                Total: {{ cartLs.total() }}<strong class="total"></strong>
              </td>
              <td></td>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
// import { add, remove, destroy, quantity, list, total } from 'cart-localstorage';
import * as cartLs from "cart-localstorage";

export default {
  name: "Dishes",
  data() {
    return {
      cartLs,
      srvApi: "http://127.0.0.1:8000",
      dishes: [],
      cartItem: [],
    };
  },
  mounted() {
    // restaurant slug ---> this.$route.params.slug
    // Chiamata api piatti - ristorante
    this.getDishes(this.$route.params.slug);

    // Carico carrello da storage
    this.cartItem = this.cartLs.list();
    // Ricarico carrello a ogni cambiamento
    cartLs.onChange(() => {
      this.cartItem = this.cartLs.list();
    });

    // cartLs.destroy();
    // console.log(this.cartLs.total());
    // console.log(this.cartLs.list());
    // console.log(localStorage);
    // console.log(localStorage.__cart);
    // this.renderCart(cartLs.list())
  },
  methods: {
    logging(par) {
      console.log(par);
      console.log(this.cartLs.list());
    },

    getDishes(slug) {
      axios
        .get(`${this.srvApi}/api/dishes/${slug}`)
        .then((res) => {
          this.dishes = res.data;
          console.log(res.data);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="scss" scoped></style>
