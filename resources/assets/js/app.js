
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('avances-component', require('./components/Avances/Avances.vue'));
// Vue.component('semaforo-component', require('./components/Semaforo.vue'));
// Vue.component('avance_board-component', require('./components/AvanceBoard.vue'));

import { store } from './components/Avances/store.js';

const app = new Vue({
    el: '#app',
    store,
});
