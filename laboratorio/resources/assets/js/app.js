
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//material design components
window.mdc = require('material-components-web/index.js');
window.mdc.autoInit();

//Vue
window.Vue = require('vue');
Vue.config.devtools = true;
Vue.config.performance = true;
Vue.config.productionTip = false

import router from './router';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('App', require('./App.vue'));
//import App from './App.vue';
const app = new Vue({
    el: '#app',
    router,
    components: {App},
    render: h => h(App)
});