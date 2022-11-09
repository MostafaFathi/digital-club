/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from "vue";

require('./bootstrap');
require('vue');

import VueRouter from 'vue-router'
import Multiselect from 'vue-multiselect'
import Helpers from "./mixins/Helpers";
import VueConfirmDialog from 'vue-confirm-dialog'
import VuePNotify from 'vue-pnotify'



const Home = () => import("./components/Home")
const UserProfile = () =>import( "./components/User/UserProfile");

const EventIndex = () =>import( "./components/Event/Index");
const EventEdit = () =>import( "./components/Event/Edit");
const EventAdd = () =>import( "./components/Event/Add");

const MemberIndex = () =>import( "./components/Member/Index");
const MemberEdit = () =>import( "./components/Member/Edit");
const MemberAdd = () =>import( "./components/Member/Add");
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */



Vue.use(require('vue-resource'));
Vue.use(VueRouter)
Vue.mixin(Helpers);
Vue.use(VueConfirmDialog)
Vue.use(VuePNotify)

Vue.filter("shortDate", function (value) {
    return Moment(value).format("L");
});

Vue.filter("key_to_title", function (value) {
    let result = value.split('_').join(' ');
    return result.charAt(0).toUpperCase() + result.slice(1)

});
Vue.component('vue-confirm-dialog', VueConfirmDialog.default)

Vue.component('loader', require('./components/Loader.vue').default);
Vue.component('map-component', require('./components/Map.vue').default);
Vue.component('notify', require('./mixins/Notify.vue').default);
Vue.component('multiselect', Multiselect)
Vue.component('pagination', require('laravel-vue-pagination'));


const routes = [
    {
        path: '/admin/', component: Home, meta: {
            breadcrumb: 'Home'
        }
    },
    {
        path: '/admin/home', component: Home, meta: {
            breadcrumb: 'Home'
        }
    },
    {
        path: '/admin/profile', component: UserProfile, meta: {
            breadcrumb: 'Profile'
        }
    },
    {
        path: '/admin/events', component: EventIndex, meta: {
            breadcrumb: 'Event'
        }
    },
    {
        path: '/admin/events/add', component: EventAdd, meta: {
            breadcrumb: 'Event'
        }
    },
    {
        path: '/admin/events/edit/:id', component: EventEdit, meta: {
            breadcrumb: 'Event'
        }
    },
    {
        path: '/admin/events/:id', component: EventAdd, meta: {
            breadcrumb: 'Event'
        }
    },
    {
        path: '/admin/members', component: MemberIndex, meta: {
            breadcrumb: 'Member'
        }
    },
    {
        path: '/admin/members/add', component: MemberAdd, meta: {
            breadcrumb: 'Member'
        }
    },
    {
        path: '/admin/members/edit/:id', component: MemberEdit, meta: {
            breadcrumb: 'Member'
        }
    },
    {
        path: '/admin/members/:id', component: MemberAdd, meta: {
            breadcrumb: 'Member'
        }
    }
]

const router = new VueRouter({mode: 'history', routes: routes});
const app = new Vue({
    data: {
        settings: [],
        axiosInterceptor: null,
        user: null,
        role: null,
        refCount: 0,
        target: null,
        isLoading: false
    },
    mounted() {
        let that = this
        $('#loading_overlay').addClass('d-none')
        this.get_auth_user();
    },
    methods: {

        setLoading(isLoading, method = null, target = null) {
            if (isLoading) {
                this.refCount++;
                if (method === 'post') {
                    console.log(target,'first')
                    $(target).addClass('disabled')
                    $(target).attr('disabled','disabled')
                    $(target).append('<i class="fa fa-spinner spinner" style="margin-right: 5px"></i>')
                } else {
                    this.isLoading = true;
                }
            } else if (this.refCount > 0) {
                $(target).removeClass('disabled')
                $(target).removeAttr('disabled')
                $(target).find('.fa-spinner').remove();
                this.refCount--;
                this.isLoading = (this.refCount > 0);
            }
        },
        get_auth_user() {
            axios.get('/vue/user/authentication').then((response) => {
                this.user = response.data.user;
                this.role = response.data.user.role;
            })
        }
    }, created() {

        axios.interceptors.request.use((config) => {
            // trigger 'loading=true' event here

            if (config.headers.e != undefined) this.target = config.headers.e.target;

            this.setLoading(true, config.method, this.target);
            return config;
        }, (error) => {
            // trigger 'loading=false' event here
            this.setLoading(false, null, this.target);
            return Promise.reject(error);
        });


        axios.interceptors.response.use((response) => {
            // trigger 'loading=false' event here
            this.setLoading(false, null, this.target);
            return response;
        }, (error) => {
            this.setLoading(false, null, this.target);
            // trigger 'loading=false' event here
            return Promise.reject(error);
        });
    },
    router
}).$mount('#app')
