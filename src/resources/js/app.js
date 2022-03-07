require('./bootstrap');

window.Vue = require('vue').default;

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)

import 'es6-promise/auto'


import router from "./router";

Vue.component('App', require('./views/App.vue').default);

Vue.component('v-header', require('./components/Header.vue').default);
Vue.component('v-hero', require('./components/Hero.vue').default);
Vue.component('little-chart', require('./components/LittleChart.vue').default);
Vue.component('v-footer', require('./components/Footer.vue').default);

const app = new Vue({
    el: '#app',
    // components: { App },
    router,
});
