<template>
  <header class="container">
    <nav class="my_nav navbar navbar-expand-lg navbar-light bg-white">
      <router-link :to="{ name: 'home' }" class="navbar-brand">
        <img src="/images/logo-DeliveBoo.svg" height="30" alt="DeliveBoo" />
      </router-link>

      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          
          <li class="nav-item">
            <router-link :to="{ name: 'restaurants' }" class="nav-link"
              >Ristoranti</router-link
            >
          </li>

          <!-- dropdown carrello -->
          <li class="nav-item nav-item-cart"
          v-if="$route.name != 'payment'"
          @click="isOpen = true">
              <a class="nav-link" href="#">
                <i class="fa fa-shopping-cart"></i>
                Carrello<span v-if="totalQuantity" class="badge ml-2">{{ totalQuantity }}</span>
              </a>
              <transition name="fade" appear>
                <div class="dropped-cart" v-if="isOpen">

                  <!-- chiudi carrello  -->
                  <i v-on:click.stop="isOpen = !isOpen" class="fas fa-window-close fa-lg"></i>

                  <!-- singolo piatto (quantità) -->
                  <div class="container-single-item" v-for="item in cart" :key="item.id">

                    <!-- immagine titolo e prezzo singolo  -->
                    <div class="item-img-text">
                      <img
                        :src="'/storage/' + item.img"
                        :alt="item.name"/>
                      <h5>
                        {{ item.name }} 
                        <small>({{ item.price }}€)</small>
                      </h5>
                    </div>

                    <!-- quantità, subtotale, elimina piatto  -->
                    <div class="item-modify">
                      <h6>
                        Quantità: {{ item.quantity }}
                        <!-- aggiungi  -->
                        <i @click="cartLs.quantity(item.id, 1)" class="fas fa-plus-square fa-lg"></i>
                        <!-- togli  -->
                        <i @click="cartLs.quantity(item.id, -1)" class="fas fa-minus-square fa-lg"></i>
                      </h6>
                      <h6>
                        Subtotale: {{ (item.price * item.quantity).toFixed(2) }}€
                      </h6>
                      <!-- ELIMINA  -->
                      <i @click="cartLs.remove(item.id)" class="fas fa-trash-alt fa-lg"></i>
                    </div>
                  </div>

                  <!-- Cart Pieno  -->
                  <div v-if="cartLs.total() > 0"  class="cart-bottom">
                  <div>
                    <!-- se presente shipping  -->
                    <h6
                      v-if="cartLs.total() < shipping_free"
                      >
                      Totale: {{ (cartLs.total() + shipping).toFixed(2) }}€
                      <button v-on:click.stop="isOpen = !isOpen" @click="cartLs.destroy()" class="btn btn-danger"><i class="fas fa-trash-alt fa-lg"></i></button>
                    </h6>
                    <!-- se non è presente shipping  -->
                      <h6 v-else>
                        Totale: {{ cartLs.total().toFixed(2) }}€
                        <button v-on:click.stop="isOpen = !isOpen" @click="cartLs.destroy()" class="btn btn-danger"><i class="fas fa-trash-alt fa-lg"></i></button>
                      </h6>
                    </div>
                  </div>

                  <!-- cart vuoto -->
                  <div v-else class="cart-bottom">
                    <h6>Carrello Vuoto</h6>
                  </div>
                    

                  <!-- route per pagamento  -->
                  <div>
                    <router-link v-if="cartLs.total() == 0" :to="{name:'payment'}"><button disabled class="btn btn-success">Vai al pagamento</button></router-link>
                    <router-link v-else :to="{name:'payment'}"><button class="btn btn-success">Vai al pagamento</button></router-link>
                  </div>
                </div>
              </transition>
          </li>
          <!-- // dropdown carrello -->

          
          <li class="nav-item ml-3">
            <a class="nav-link" href="/login" v-if="user == 'null'" >Registrati o accedi</a>
            <a class="nav-link" href="/admin" v-else >Dashboard</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- <Jumbotron /> -->
  </header>
</template>

<script>
import * as cartLs from "cart-localstorage";

export default {
  name: "Header",
  data () {
    return {
      isOpen: false,
      // carts returns
      cartLs,
      srvApi: "http://127.0.0.1:8000",
      shipping: 0,
      shipping_free: 0,
      orderFree: false,
    }
  },
  props: {
    cart: {
      type: Array,
      required: true,
    },
    totalQuantity: {
      type: Number,
      required: true,
    },
    user: String
  },
  updated() {
    // Chiamata api ristorante shipping
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
  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/front";

.user {
  color: $azure;
}
// general head 
.my_nav .navbar-nav .nav-link.active {
  color: $azure;
}
.navbar-light .navbar-nav .nav-link:hover {
  color: $azure_dark;
}
span.badge {
  background-color: $violet;
  color: white;
  line-height: 1.5;
  vertical-align: middle;
}
.nav-item-cart {
  position: relative;
}

.dropped-cart {
  // border: 1px solid black;
  border-radius: 5px;
  padding: 10px;
  position: absolute;
  background-color: white;
  z-index: 2;
  max-height: 420px;
  min-width: 250px;
  overflow-y: auto;
  box-shadow: -2px -2px 10px;
  .fa-window-close {
    cursor: pointer;
    position: absolute;
    left: 85%;
    color: $red;
  }
  .container-single-item {
    border-bottom: 1px solid black;
    padding: 10px 0;
    .item-img-text {
      display: flex;
      align-items: center;
      img {
            width: 50px;
          }
          h5 {
            display: flex;
            
            small {
              font-size: 0.5em;
              align-self: center;
            }
          }
    }
    .item-modify {
      h6 {
        font-size: 0.8rem;
        i {
          color: $azure;
        }
      }
      i {
        cursor: pointer;
      }
    }
  }
  .btn-success {
    width: 100%;
  }

  .cart-bottom {
    padding: 5px;
    h6 {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  }
}
</style>