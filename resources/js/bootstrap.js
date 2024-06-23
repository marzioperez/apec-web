import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import {default as Splide} from "@splidejs/splide";
window.Splide = Splide;

import {default as flatpickr} from "flatpickr";
window.dateTimePicker = (input, date = null)=> flatpickr(input,{defaultDate: date?new Date(date): new Date(),dateFormat:'d-m-Y H:i', enableTime: true})
window.onload = function () {
    flatpickr('[datepicker]',
        {
            dateFormat: 'd-m-Y',
            altFormat: 'd-m-Y'
        }
    );
}

import QrScanner from "qr-scanner";
window.QrScanner = QrScanner;
