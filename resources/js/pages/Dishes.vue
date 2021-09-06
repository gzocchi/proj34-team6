<template>
  <section class="text-center py-5 my-5">
    <div class="container">
      <div class="card-deck mt-4 mb-4 text-center">
        <div
          class="card mb-4 shadow-sm"
          v-for="product in products"
          :key="product.id"
        >
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{ product.name }}</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">${{ product.price }}</h1>

            <button
              type="button"
              class="btn btn-block btn-outline-primary"
              @click="cartLs.add(product)"
            >
              Add to Cart
            </button>

            <button
              type="button"
              class="btn btn-sm btn-outline-primary"
              @click="cartLs.quantity(product.id, 1)"
            >
              +
            </button>

            <button
              type="button"
              class="btn btn-sm btn-outline-primary"
              @click="cartLs.quantity(product.id, -1)"
            >
              -
            </button>

            <button class="btn btn-primary" @click="cartLs.remove(product.id)">
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
      cartItem: [],
      products: [
        {
          id: 7,
          name: "Panino",
          price: 5.0,
          restaurant_id: 1,
        },
        {
          id: 8,
          name: "Panino Grande",
          price: 12,
          restaurant_id: 1,
        },
        {
          id: 3,
          name: "Bibita",
          price: 2,
          restaurant_id: 1,
        },
        
      ],
    };
  },
  mounted() {
    // restaurant slug ---> this.$route.params.slug
    console.log(this.$route.params.slug);
    // Carico inizialmente carrello da storage
    this.cartItem = this.cartLs.list();
    // refresh carrello ogni cambiamento
    cartLs.onChange(() => {
      this.cartItem = this.cartLs.list();
    });

    // cartLs.destroy();
    cartLs.add({ id: 1, name: "Product 1", price: 100, restaurant_id: 3 });
    cartLs.add({ id: 2, name: "Product 2", price: 100, restaurant_id: 3 }, 2);
    console.log(this.cartLs.total());
    console.log(this.cartLs.list());
    console.log(localStorage);
    console.log(localStorage.__cart);
    // this.renderCart(cartLs.list())
  },
  methods: {
    logging(par) {
      console.log(par);
      console.log(this.cartLs.list());
    },
    // renderCart(items) {
    // console.log(items);
    // const $cart = document.querySelector(".cart")
    // const $total = document.querySelector(".total")

    // $cart.innerHTML = items.map((item) => `
    // 		<tr>
    // 			<td>#${item.id}</td>
    // 			<td>${item.name}</td>
    // 			<td>${item.quantity}</td>
    // 			<td style="width: 60px;">
    // 				<button type="button" class="btn btn-block btn-sm btn-outline-primary"
    // 					@click="prodPlus(${item.id})">+</button>
    // 			</td>
    // 			<td style="width: 60px;">
    // 				<button type="button" class="btn btn-block btn-sm btn-outline-primary"
    // 					@click="quantity(${item.id},-1)">-</button>
    // 			</td>
    // 			<td class="text-right">€${item.price}</td>
    // 			<td class="text-right"><Button class="btn btn-primary" @click="remove(${item.id})">Delete</Button></td>
    // 		</tr>`).join("")

    // $total.innerHTML = "€" + cartLs.total()
    // },
    // renderCart(cartLS.list()),
    // cartLS.onChange(renderCart),
  },
  computed: {},
};
</script>

<style lang="scss" scoped></style>
