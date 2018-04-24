
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap.js';
import Vue from 'vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('dashboard', require('./components/Dashboard.vue'));
Vue.component('cryptoboard', require('./components/Cryptoboard.vue'));

Vue.filter('toCurrency', function (value) {
    if (typeof value !== "number") {
        value = parseFloat(value);
    }
    let formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    });
    return formatter.format(value);
});


const app = new Vue({
    el: '#app'
});


///////////
// Misc
///////////
for (let toast of ['#errorMessageToast', '#messageToast']) {
    $(toast).delay(500).fadeIn(250).delay(2000).fadeOut(2000);
}

/**
 * @param msg
 * @returns {boolean}
 * @constructor
 */
window.ConfirmDelete = function(msg) {
    return confirm("Are you sure you want to delete " + msg + " ?");
}

