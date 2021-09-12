<template>
  <section v-if="loader" class="text-center py-5 my-5">
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
              <tr v-for="item in cart" :key="item.id">
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

          <!-- FORM -->
          <v-form class="form">
            <template>
              <h2>Indirizzo di consegna</h2>
              <!-- INPUT ADDRESS -->
              <label class="mt-3" for="address">Indirizzo</label>
              <v-text-field
                class="input"
                id="address"
                placeholder="es.Via Ettore Ponti, 21"
                v-model="form.customer_address"
                color="#006d68"
                :rules="[
                  (v) => !!v || 'Indirizzo obbligatorio',
                  (v) =>
                    (v && v.length <= 50) ||
                    'l\'indirizzo può contenere massimo 50 caratteri',
                  (v) =>
                    (v && v.length >= 3) ||
                    'l\'indirizzo deve contenere minimo 3 caratteri',
                ]"
                hide-details="auto"
              ></v-text-field>
              <!-- ERROR -->
              <div class="form-error" v-show="any_errors">
                <span
                  v-for="error in errors['customer_telephone']"
                  :key="error"
                >
                  {{ error }}
                </span>
              </div>
              <label class="mt-3" for="telephone">Telefono</label>
              <v-text-field
                class="input"
                id="telephone"
                placeholder="es. 333333333333"
                v-model="form.customer_telephone"
                color="#006d68"
                :rules="[
                  (v) => !!v || 'Numero obbligatorio',
                  (v) =>
                    (v && v.length <= 10) ||
                    'il numero deve contenere massimo 9 caratteri',
                  (v) =>
                    (v && v.length >= 9) ||
                    'il numero deve contenere minimo 10 caratteri',
                ]"
                hide-details="auto"
              ></v-text-field>
              <!-- ERROR -->
              <div class="form-error" v-show="any_errors">
                <span v-for="error in errors['customer_address']" :key="error">
                  {{ error }}
                </span>
              </div>
              <!-- NAME AND EMAIL -->
              <div class="name-and-email" id="name-and-email">
                <div class="name mt-3" id="name">
                  <label for="nome">Nome</label>
                  <v-text-field
                    class="input"
                    color="#006d68"
                    placeholder="es. Luigi Verdi"
                    v-model="form.customer_name"
                    :rules="[(v) => !!v || 'Nome obbligatorio']"
                    hide-details="auto"
                  ></v-text-field>
                  <!-- ERROR -->
                  <div class="form-error" v-show="any_errors">
                    <span v-for="error in errors['customer_name']" :key="error">
                      {{ error }}
                    </span>
                  </div>
                </div>
                <div class="email mt-3" id="email">
                  <label for="email">Email</label>
                  <v-text-field
                    class="input"
                    color="#006d68"
                    v-model="form.customer_mail"
                    placeholder="es. verdiluigi@gmail.com"
                    :rules="[
                      (v) => !!v || 'Email obbligatoria',
                      (v) =>
                        /^(([^<>()[\]\.,;:\s@']+(\.[^<>()\[\]\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
                          v
                        ) || 'Inserisci una mail valida',
                    ]"
                    hide-details="auto"
                  ></v-text-field>
                  <!-- ERROR -->
                  <div class="form-error" v-show="any_errors">
                    <span v-for="error in errors['customer_mail']" :key="error">
                      {{ error }}
                    </span>
                  </div>
                </div>
              </div>
            </template>
            <h2 class="payment-method mt-5">Metodo di pagamento</h2>
            <v-braintree
              class="braintree"
              locale="it_IT"
              :vaultManager="true"
              :authorization="tokenApi"
              @success="onSuccess"
              @error="onError"
            >
              <template v-slot:button="slotProps">
                <v-btn class="submit btn btn-success" @click="slotProps.submit">
                  <svg
                    height="24"
                    width="24"
                    viewBox="0 0 24 24"
                    class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205"
                  >
                    <path
                      d="M18 9H20V21H4V9H6C6 5.69158 8.69158 3 12 3C15.3084 3 18 5.69158 18 9ZM6 19H18V11H6V19ZM8 9H16C16 6.79442 14.2056 5 12 5C9.79442 5 8 6.79442 8 9ZM11.5 16V14H12.5V16H11.5Z"
                    ></path>
                  </svg>
                  Paga
                </v-btn>
              </template>
            </v-braintree>
          </v-form>
        </div>
      </div>
    </div>
  </section>

  <!-- <Loader v-else /> -->
</template>

<script>
import * as cartLs from "cart-localstorage";
import Loader from "../components/Loader";
import vuebraintree from "vue-braintree";
export default {
  name: "Payment_Fabio",
  props: {
    cart: {
      type: Array,
      required: true,
    },
  },
  components: { Loader },
  data() {
    return {
      cartLs,
      srvApi: "http://127.0.0.1:8000",
      shipping: 0,
      shipping_free: 0,
      tokenApi: "",
      loader: false,
      form: {
        token: "",
        dishes: cartLs.list(),
        restaurantId: cartLs.list()[0].restaurant_id,
        customer_name: "",
        // customer_email: "",
        customer_address: "",
        customer_telephone: "",
        // customer_cap : "",
        // customer_city : "",
      },
      errors: {},
      any_errors: false,
      my_order: [],
      check: false,
    };
  },
  mounted() {
     // Chiamata api ristorante shipping
  //   this.getShipping(this.cartLs.list()[0].restaurant_id);
    this.generateKey();
  //   // this.paymentCart();
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
    },
    // paymentCart(){
    //   let contents = $this.cartLs.list();
    //   this.my_order = contents;
    //   contents.forEach(product=>{
    //     this.form.products.push({
    //     productId : product.id,
    //     qty : product.qty,
    //     });
    //   })
    // },
    async generateKey() {
      this.loader = false;
      await axios
        .get("http://127.0.0.1:8000/api/orders/generate")
        .then((res) => {
         console.log(res.data.token);
          this.tokenApi = res.data.token;
          this.loader = true;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    onSuccess(payload) {
      this.loader = false;
      this.form.token = payload.nonce;
      this.buy();
    },
    onError(error) {
      let message = error.message;
    },
    async buy() {
      try {
        axios
          .post("http://127.0.0.1:8000/api/orders/make/payment", {
            ...this.form,
          })
          .then((res) => {
            localStorage.clear();
            if (res.data.errors) {
              this.errors = res.data.errors;
              this.any_errors = true;
              this.loader = true;
            } else {
              this.any_errors = false;
              return this.$router.push("/checkout/success");
            }
          })
          .catch((err) => {
            return this.$router.push("/checkout/error");
          });
      } catch (error) {
        this.loader = false;
      }
    },
    // paymentCart() {
    //   let contents = JSON.parse(
    //     localStorage.getItem(this.$route.params.restaurantId)
    //   );
    //   this.my_order = contents;
    //   contents.forEach((product) => {
    //     this.form.products.push({
    //       productId: product.id,
    //       qty: product.qty,
    //     });
    //   });
    // },
    checked() {
      this.check = !this.check;
    },
  },
};
</script>

<style lang="scss" scoped></style>