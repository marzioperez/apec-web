import axios from 'axios';
import {default as flatpickr} from "flatpickr";
import {Spanish as flatpickrLocale} from 'flatpickr/dist/l10n/es';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import {default as Splide} from "@splidejs/splide";
window.Splide = Splide;

window.dateTimePicker = (input, date = null)=> flatpickr(input,{defaultDate: date?new Date(date): new Date(),dateFormat:'d-m-Y H:i', enableTime: true, plugins: [new confirmDatePlugin({confirmText:'Aceptar'})]})
window.onload = function () {
    flatpickr('[datepicker]',
        {
            locale: flatpickrLocale,
            dateFormat: 'd-m-Y',
            altFormat: 'd-m-Y',
        }
    );
}
