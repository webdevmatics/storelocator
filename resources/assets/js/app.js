
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify'

Vue.use(Vuetify)

import * as VueGoogleMaps from 'vue2-google-maps';

window.Bus=new Vue;

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyCLbarhqrxyP9XUh29eJzGQnbqbjgITShY',
        libraries: 'places', //// If you need to use place input
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('shop-layout', require('./components/ShopLayout.vue'));
Vue.component('shop-map', require('./components/ShopMap.vue'));
Vue.component('place-search', require('./components/PlaceSearch.vue'));
Vue.component('results', require('./components/Results.vue'));

const app = new Vue({
    el: '#app'
});
