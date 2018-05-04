import Vue from 'vue';

import credit from './components/credit.vue'

require('../css/calculator.scss');

var $ = require('jquery');

require('bootstrap');
require('popper.js');

new Vue({
    el: '#app',
    components: {
        credit
    }
});
