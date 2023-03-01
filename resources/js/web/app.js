import Alpine from 'alpinejs';
import $ from "jquery";

window.Alpine = Alpine;

window.jQuery = window.$ = $

const feather = require('feather-icons');
feather.replace();

Alpine.start();