import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import Forgot from './components/auth/Forgot.vue';
import Home from './components/Home.vue';
import Logout from './components/auth/Logout.vue'
import Storeemployee from './components/employee/create.vue'
import Employee from './components/employee/index.vue'
import Editemployee from './components/employee/edit.vue'
export const routes = [
    { path: '/', component: Login, name:"login" },
    { path: '/register', component: Register,  name:"register" },
    { path: '/forgot', component: Forgot,  name:"forgot" },
    { path: '/home', component: Home,  name:"home" },
    { path: '/logout', component: Logout,  name:"logout" },
    { path: '/store-employee', component: Storeemployee,  name:"Storeemployee" },
    { path: '/employee', component: Employee,  name:"employee" },
    { path: '/edit-employee/:id', component: Editemployee,  name:"editemployee" },

  ]
