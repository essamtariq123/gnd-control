/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('master-component', require('./components/MasterComponent.vue').default);
Vue.component('slave-component', require('./components/SlaveComponent.vue').default);
Vue.component('functions-nav-bar', require('./components/FunctionsNav.vue').default);
Vue.component('suggestion-box', require('./components/SuggestionBox.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 import { rtdbPlugin } from 'vuefire'

 Vue.use(rtdbPlugin)


//  Vue.use(firebase) 
 
//  var config = {
//     apiKey: 'AIzaSyBHBEfYi6r4f82D_7BIyTlIBe59TTqiMsg',
//     authDomain: 'gnd-control-backend.firebaseapp.com',
//     projectId: 'gnd-control-backend',
//     storageBucket: 'gnd-control-backend.appspot.com',
//     messagingSenderId: '18319398742',
//     appId: '1:18319398742:web:4b811836d522ca7d6428f7'
//  };
//  firebase.initializeApp(config);

const app = new Vue({
    el: '#app',
});
