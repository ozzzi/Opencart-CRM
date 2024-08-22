import Alpine from "alpinejs";
import persist from '@alpinejs/persist'
import axios from "axios";

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios = axios

Alpine.plugin(persist)
window.Alpine = Alpine;
Alpine.start();
