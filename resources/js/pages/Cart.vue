<template>
  <section class="text-center py-5 my-5">
    <div class="row">
      <div class="card mb-4 shadow-sm col-12">
        <div class="card-header">
          <h2>Cart</h2>

          <h5 v-if="shipping > 0">Spese di spedizione {{ shipping }} €</h5>
          <h5 v-else>Spedizione Gratuita!</h5>

          <h6 v-if="shipping > 0 && shipping_free > 0">
            Spedizione gratuita per ordini superiori a:
            {{ shipping_free }} €
          </h6>
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
              <td :colspan="[orderFree ? 5 : 3]"></td>

              <td v-if="orderFree" class="text-right">
                Spedizione Gratuita<strong class="total"></strong>
              </td>
              <td v-else class="text-right">
                Spedizione: {{ shipping }}<strong class="total"></strong>
              </td>

              <td v-if="!orderFree" class="text-right">
                SubTotal: {{ cartLs.total() }}<strong class="total"></strong>
              </td>

              <td v-if="!orderFree" class="text-right">
                Total: {{ cartLs.total() + shipping }}<strong class="total"></strong>
              </td>
              <td v-else class="text-right">
                Total: {{ cartLs.total() }}<strong class="total"></strong>
              </td>
              
              <td></td>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- <Loader v-else /> -->
</template>

<script>
import * as cartLs from "cart-localstorage";
import Loader from "../components/Loader";

export default {
  name: "Cart",
  components: { Loader },
  data() {
    return {
      cartLs,
      srvApi: "http://127.0.0.1:8000",
      shipping: 0,
      shipping_free: 0,
      cartItem: [],
      orderFree: false
    };
  },
  mounted() {
    // Carico carrello da storage
    this.cartItem = this.cartLs.list();

    // Ricarico carrello a ogni cambiamento
    cartLs.onChange(() => {
      this.cartItem = this.cartLs.list();
    });

    // Chiamata api ristorante shipping
    this.getShipping(this.cartItem[0].restaurant_id);
  },
  watch: {
    cartItem(val) {
      if (this.shipping_free) {
        return cartLs.total() > this.shipping_free
          ? (this.orderFree = true)
          : (this.orderFree = false);
      } else {
        this.orderFree = false;
      }
    },
  },
  methods: {
    getShipping(restaurant_id) {
      axios
        .get(`${this.srvApi}/api/${restaurant_id}/shipping`)
        .then((res) => {
          this.shipping = res.data.shipping;
          this.shipping_free = res.data.shipping_free;
          if(this.shipping == 0) {
            this.orderFree = true
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="scss" scoped></style>
