import VueRouter from 'vue-router';
import VeeValidate from 'vee-validate';
import Toastr from 'vue-toastr';
import BootstrapVue from 'bootstrap-vue';

import router from './routes';
import {filters} from './filters';
import Auth from './auth';
import Api from './api';

require('vue-toastr/src/vue-toastr.scss');
require('./bootstrap');

window.Vue = require('vue');
window.api = new Api();
window.auth = new Auth();
window.Event = new Vue;

Vue.config.productionTip = false;

Vue.use(VeeValidate);
Vue.use(VueRouter);
Vue.use(Toastr, {
    defaultTimeout: 3500,
    defaultPosition: "toast-top-center",
});
Vue.use(BootstrapVue);

Vue.component('app-wrapper', require('./components/Wrapper.vue').default);

const app = new Vue({
    el: '#app',
    router,
    filters
});