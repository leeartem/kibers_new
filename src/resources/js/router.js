import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Home from './views/Home'
import Coin from './views/Coin'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/coin/:uuid',
        name: 'coin',
        component: Coin,
    },
];

export default new vueRouter({
    mode: "history",
    routes
});