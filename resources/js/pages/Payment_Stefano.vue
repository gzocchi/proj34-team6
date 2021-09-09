<template>
  <section class="text-center py-5 my-5">
    <div class="row">
      <div class="card mb-4 shadow-sm col-12">
        <div class="card-header">
          <h2>Cart</h2>
          <h6>
            Spedizione gratuita per ordini superiori a: {{ shipping_free }} €
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
              <td colspan="3"></td>
              <td class="text-right">
                Spedizione: {{ shipping }}<strong class="total"></strong>
              </td>
              <td class="text-right">
                SubTotal: {{ cartLs.total() }}<strong class="total"></strong>
              </td>
              <td class="text-right">
                Total: {{ cartLs.total() + shipping
                }}<strong class="total"></strong>
              </td>
              <td></td>
            </tfoot>
          </table>
            <v-braintree
              class="braintree"
              locale="it_IT"
              :vaultManager="true"
              :authorization=tokenApi
              @success="onSuccess"
              @error="onError"
              >
              <template v-slot:button="slotProps">
                <v-btn class="submit" @click="slotProps.submit">
                  <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205"><path d="M18 9H20V21H4V9H6C6 5.69158 8.69158 3 12 3C15.3084 3 18 5.69158 18 9ZM6 19H18V11H6V19ZM8 9H16C16 6.79442 14.2056 5 12 5C9.79442 5 8 6.79442 8 9ZM11.5 16V14H12.5V16H11.5Z"></path></svg>
                  Ordina per la consegna
                </v-btn>
              </template>
            </v-braintree>
        </div>
      </div>
    </div>
  </section>

  <!-- <Loader v-else /> -->
</template>

<script>
import * as cartLs from "cart-localstorage";

export default {
  name: "Cart",
  data() {
    return {
      cartLs,
      srvApi: "http://127.0.0.1:8000",
      shipping: 0,
      shipping_free: 0,
      cartItem: [],
      tokenApi: 'sandbox_csbr2kws_f6hws46tc8hgy98s',
      form : {
        token : "",
        products : [],
        restaurantId : this.$route.params.restaurantId,
        payer_name : "",
        payer_email : "",
        payer_address : "",
        payer_cap : "",
        payer_city : "",
      },
      errors: {},
      any_errors: false,
      my_order : [],
      check : false,
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
  methods: {
    getShipping(restaurant_id) {
      axios
        .get(`${this.srvApi}/api/${restaurant_id}/shipping`)
        .then((res) => {
          this.shipping = res.data.shipping;
          this.shipping_free = res.data.shipping_free;
        })
        .catch((err) => {
          console.log(err);
        });
    }
  }
};
</script>

<style lang="scss" scoped></style>