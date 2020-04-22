require('./bootstrap');

//import 'bootstrap';
//import 'bootstrap/dist/css/bootstrap.min.css'

import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

window.Vue = require('vue');

import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(VueAxios, axios);
Vue.use(BootstrapVue)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
