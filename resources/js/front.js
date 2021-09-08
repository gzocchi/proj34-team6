window.Vue = require("vue");

window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import App from "./App.vue";
import router from "./router.js";
import Vue from "vue";
import Vuetify from "vuetify";
import vuebraintree from "vue-braintree";

Vue.use(Vuetify);
Vue.use(vuebraintree);

const app = new Vue({
    el: "#root",
    render: h => h(App),
    router,
    Vuetify,
    vuebraintree
});