// gestione dipendenze
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "./pages/Home";
import Dishes from "./pages/Dishes";

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
            path: "/restaurant/:slug/dishes",
            name: "dishes",
            component: Dishes
        },
    ]
});

export default router;
