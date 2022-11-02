/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from "vue";

require('./bootstrap');
require('vue');

import VueRouter from 'vue-router'

import Home from "./components-web/Home";
import CreateAccount from "./components-web/CreateAccount";
import Join from "./components-web/Join";
import Login from "./components-web/Login";
import Member from "./components-web/Member";
import Partners from "./components-web/Partners";
import WhoWeAre from "./components-web/WhoWeAre";
import EventIndex from "./components-web/Event/Index";
import EventShow from "./components-web/Event/Show";
import EventDetail from "./components-web/Event/Detail";
import VerifyAccount from "./components-web/VerifyAccount";

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


Vue.use(VueRouter)
Vue.use(VueSweetalert2);

Vue.component('loader', require('./components-web/Loader.vue').default);
// Vue.component('notify', require('./mixins/Notify.vue').default);
const routes = [

    {
        path: '/', component: Home, meta: {
            breadcrumb: 'Home'
        }
    },
    {
        path: '/create-account', component: CreateAccount, meta: {
            breadcrumb: 'CreateAccount'
        }
    },
    {
        path: '/verify-account', component: VerifyAccount, name: 'verify-account', meta: {
            breadcrumb: 'VerifyAccount'
        }
    },
    {
        path: '/join', component: Join, meta: {
            breadcrumb: 'Join'
        }
    },
    {
        path: '/members', component: Member, meta: {
            breadcrumb: 'Member'
        }
    },
    {
        path: '/partners', component: Partners, meta: {
            breadcrumb: 'Partners'
        }
    },
    {
        path: '/who-we-are', component: WhoWeAre, meta: {
            breadcrumb: 'WhoWeAre'
        }
    },
    {
        path: '/events', component: EventIndex, meta: {
            breadcrumb: 'EventIndex'
        }
    },
    {
        path: '/events/:type', component: EventShow, meta: {
            breadcrumb: 'EventShow'
        }
    },
    {
        path: '/events/:type/details', component: EventDetail, meta: {
            breadcrumb: 'EventDetail'
        }
    },
    {
        path: '/login', component: Login, meta: {
            breadcrumb: 'Login',
            redirectIfAuth: true
        }
    },
]

const router = new VueRouter({mode: 'history', routes: routes});


router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.redirectIfAuth)) {
        if (localStorage.getItem('bearer_token') != null) {
            next({
                path: '/',
                params: {nextUrl: to.fullPath}
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem('bearer_token') == null) {
            next({
                path: '/auth',
                params: {nextUrl: to.fullPath}
            })
        } else {
            next()
        }
    } else {
        next()
    }
})

const app = new Vue({
    data: {
        settings: [],
        isLoading: false,
        axiosInterceptor: null,
        view_footer: false,
        authorization: {
            Authorization: 'Bearer ' + localStorage.bearer_token,
        },
        client: {},
        is_authed: false,
        locale: '',

    },
    created() {
        this.is_authed_used();
    },
    mounted() {
        let that = this
        $('#loading_overlay').addClass('d-none')
    },
    methods: {
        is_authed_used() {
            this.is_authed = localStorage.bearer_token !== undefined && localStorage.bearer_token !== '';
        },
    },
    router
}).$mount('#app')
