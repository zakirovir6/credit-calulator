import Vue from 'vue';

import CreditForm from './components/credit-form.vue'

require('../css/calculator.scss');

let $ = require('jquery');

require('bootstrap');
require('popper.js');

new Vue({
    el: '#app',
    components: {
        CreditForm
    }
});
