<template>
  <section v-if="loader" class="text-center py-5 my-5">
    <div class="row">
      <div class="card mb-4 shadow-sm col-12">
        <div class="card-header text-white">
          <h2>Cart</h2>
          <h6>
            Spedizione gratuita per ordini superiori a: {{ shipping_free }} €
          </h6>
        </div>
        <div class="card-body">


          <!-- riepilogo ordine modificabile -->
          <div class="container container-riepilogo">
            <div class="riepilogo-piatto" v-for="item in cart" :key="item.id">
                <div class="row">
                  <div class="col">
                    <img
                          :src="'/storage/' + item.img"
                          :alt="item.name"/>
                  </div>
                  <div class="col">{{ item.name }}</div>
                  <div class="col">
                    {{ item.quantity }}
                    <i @click="cartLs.quantity(item.id, 1)" class="fas fa-plus-square fa-lg"></i>
                        <!-- togli  -->
                    <i @click="cartLs.quantity(item.id, -1)" class="fas fa-minus-square fa-lg"></i>
                  </div>
                  <div class="col">
                    <i @click="cartLs.remove(item.id)" class="fas fa-trash-alt fa-lg"></i>
                  </div>
                </div>
            </div>
                <div class="card-footer">
                  <h6 class="text-left">
                    Spedizione: {{ shipping }}€<strong class="total"></strong>
                  </h6>
                  <h6 class="text-left">
                    SubTotal: {{ cartLs.total() }}€<strong class="total"></strong>
                  </h6>

                  <!-- totale visto  -->
                  <div v-if="cartLs.total() > 0">
                    <h4 class="text-right" v-if="cartLs.total() < shipping_free ">Totale: {{ (cartLs.total() + shipping).toFixed(2) }}€</h4>

                    <h4 class="text-right" v-else>Totale: {{ cartLs.total().toFixed(2) }}€</h4>
                  </div>
                  <!-- totale 0 -->
                  <div v-else>
                    <div class="content">
                      <i class="fas fa-times"></i>
                      <h1>Ops, qualcosa è andato storto...</h1>
                      <div>Siamo spiacenti, il carrello è vuoto. Come compagnia siamo propensi a far pagare al cliente solo ciò che compra. <br>
                        Riprova scegliendo cosa inserire nel carrello!
                      </div>
                      <router-link :to="{name:'home'}"><button class="btn my_btn btn-primary my-3">Torna alla home</button></router-link>
                    </div>                   
                  </div>
                </div>
          </div>

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

  <Loader v-else />
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
        customer_mail: "",
        customer_address: "",
        customer_telephone: "",
      },
      errors: {},
      any_errors: false,
      my_order: [],
      check: false,
    };
  },
  mounted() {
     // Chiamata api ristorante shipping
    this.generateKey();
  //   // this.paymentCart();
  this.getShipping(this.cartLs.list()[0].restaurant_id);
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
          if (this.shipping == 0) {
            this.orderFree = true;
          }
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
        //  console.log(res.data.token);
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
            // console.log(res.data);
            if (res.data.errors) {
              // console.log(res.data.errors);
              this.errors = res.data.errors;
              this.any_errors = true;
              this.loader = true;
            } else {
              this.any_errors = false;
              cartLs.destroy();
              return this.$router.push({ name: "PaymentSuccess" });
            }
          })
          .catch((err) => {
            return this.$router.push({ name: "PaymentError" });
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

<style lang="scss" scoped>
@import "../../sass/front";

.card-header {
  background-color: $azure;
}
.container-riepilogo {
  margin: 20px auto;
  box-shadow: 0px 0px 5px;
  .row {
    align-items: center;
    margin: 0;
  }
  .riepilogo-piatto {
    img {
      width: 50px;
    }
    i {
      cursor: pointer;
    }
  }
}

form 
.form {
  margin: 30px 0;
  box-shadow: 0px 0px 5px;
}
.v-input {
  width: 60%;
  margin: 0 auto;
}

// carrello vuoto error
.fa-times {
  font-size: 40px;
  color: $red;
  padding: 10px;
}

.content h1 {
  text-align: center;
  margin-bottom: 10px;
  color: $red;
}

</style>