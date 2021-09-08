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
        }
    ]
});

export default router;
