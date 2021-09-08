// gestione dipendenze
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "./pages/Home";
import Restaurants from "./pages/Restaurants";
import Type from "./pages/Type";
import Restaurant from "./pages/Restaurant";
import Payment from "./pages/Payment";

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
            path: "/payment",
            name: "payment",
            component: Payment
        }
    ]
});

export default router;
