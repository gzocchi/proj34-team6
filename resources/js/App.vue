<template>
    <div class="container">
        <Header :totalQuantity="total" />

        <main class="container my-3">
            <router-view :cart="cartItem"></router-view>
        </main>

        <Footer />
    </div>
</template>

<script>
import * as cartLs from "cart-localstorage";
import Header from "./components/Header";
import Footer from "./components/Footer";

export default {
    name: "App",
    components: {
        Header,
        Footer
    },
    data() {
        return {
            cartLs,
            cartItem: [],
            total: 0
        };
    },
    mounted() {
        // Carico carrello da storage
        this.cartItem = this.cartLs.list();
        
        this.totalQuantity();

        // Ricarico carrello a ogni cambiamento
        this.cartLs.onChange(() => {
            this.cartItem = this.cartLs.list();
            this.totalQuantity();
        });
    },
    methods: {
        totalQuantity() {
            this.total = 0;
            this.cartLs.list().forEach(item => {
                this.total += item.quantity;
            });
        }
    }
};
</script>

<style lang="scss">
body {
    background-color: #f8f9fa;
}
</style>
