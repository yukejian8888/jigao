//
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * include Vue and Vue Resource. This gives a great starting point for
//  * building robust, powerful web applications using Vue and Laravel.
//  */
//
// require('./bootstrap');
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the body of the page. From here, you may begin adding components to
//  * the application, or feel free to tweak this setup for your needs.
//  */
//
// Vue.component('example', require('./components/Example.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
//http://element.eleme.io/#/zh-CN/component/quickstart
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';
import { Button, Select } from 'element-ui';
import Example from './components/Example.vue';
import App from './App.vue';
import B from './components/b.vue';

Vue.component(Button.name, Button);
Vue.component(Select.name, Select);
/* 或写为
 * Vue.use(Button)
 * Vue.use(Select)
 */


Vue.use(VueRouter);
Vue.use(VueResource);
const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    routes: [
        { path: '/e', component: Example },
        { path: '/b', component: B }
    ]
});

new Vue(Vue.util.extend({ router }, App)).$mount('#app')




