
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import {routes} from './routes';
import MainApp from './views/MainApp.vue';
import {initialize} from './helpers/general';
import VCalendar from 'v-calendar';
import 'v-calendar/lib/v-calendar.min.css';
Vue.use(VueRouter);
Vue.use(VCalendar,{
    locale: 'es-MX',
    firstDayOfWeek: 2,
    datePickerShowDayPopover: false,
    datePickerTintColor: '#313e50'
});
Vue.config.devtools = true;
Vue.config.performance = true;
Vue.config.productionTip = false;

const router = new VueRouter({
    routes,
    mode: 'history'
});

initialize(router);

const app = new Vue({
    el: '#app',
    router,
    components: {
        MainApp
    }
});
