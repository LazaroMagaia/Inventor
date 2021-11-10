

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//USER IMPORTED
import User from './Helpers/User';
window.User = User

//ROUTE IMPORTED
import {routes} from './routes.js';
const router = new VueRouter({
    routes,
    mode: "history"
});


const app = new Vue({
    el: '#app',
    router,
});
