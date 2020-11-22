require('./bootstrap');

import Vue from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Routes from './routes'


Vue.use(VueRouter)
Vue.use(VueAxios, axios)

const router = new VueRouter({
    routes: Routes
})



const app = new Vue({
    el: '#app',
    router:router
});
