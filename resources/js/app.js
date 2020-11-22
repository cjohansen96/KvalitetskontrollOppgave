require('./bootstrap');

import Vue from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'


Vue.use(VueAxios, axios)

Vue.component('vehicles', require('./components/Vehicles.vue').default);


const app = new Vue({
    el: '#app',
});
