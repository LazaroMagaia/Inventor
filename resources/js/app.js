

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//SWEETALERT2 ES6 Modules or TypeScript
import Swal from 'sweetalert2';
window.Swal = Swal

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
window.Toast = Toast


//USER IMPORTED
import User from './Helpers/User';
window.User = User
//NOTIFICATION IMPORTED
import Notification from './Helpers/Notification.js'
window.Notification = Notification

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
