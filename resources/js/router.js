// gestione dipendenze
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "./pages/Home";
import Cart from "./pages/Cart";
import Type from "./pages/Type";
import Restaurants from "./pages/Restaurants";
import Restaurant from "./pages/Restaurant";
import NotFound from "./pages/NotFound";
import Payment_Stefano from "./pages/Payment_Stefano";
import Payment_Fabio from "./pages/Payment_Fabio";
import CheckoutError from "./pages/CheckoutError";
import CheckoutSuccess from "./pages/CheckoutSuccess";

const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/cart",
            name: "cart",
            component: Cart
        },
        {
            path: "/type/:slug",
            name: "type",
            component: Type
        },
        {
            path: "/restaurants/",
            name: "restaurants",
            component: Restaurants
        },
        {
            path: "/restaurant/:slug",
            name: "restaurant",
            component: Restaurant
        },
        {
            path: "*",
            name: "not-found",
            component: NotFound
        },
        {
            path: "/paymentS",
            name: "paymentS",
            component: Payment_Stefano
        },
        {
            path: "/paymentF",
            name: "paymentF",
            component: Payment_Fabio
        },
        {
            path: "/checkout/error",
            name: "CheckoutError",
            component: CheckoutError
        },
        {
            path: "/checkout/success",
            name: "CheckoutSuccess",
            component: CheckoutSuccess
        }
    ]
});

export default router;
