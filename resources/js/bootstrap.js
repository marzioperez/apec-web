import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import {default as Splide} from "@splidejs/splide";
window.Splide = Splide;

import moment from "moment";

window.moment = moment();
