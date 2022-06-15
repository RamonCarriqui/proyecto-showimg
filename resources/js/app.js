require('./bootstrap');
import { createApp } from 'vue';
import router from './router';
import SmartTable from 'vuejs-smart-table';

const SortedTablePlugin = require("vue-sorted-table");

createApp({})
    .component("menulateral", require("./components/Menulateral.vue").default)
    .component("indexprincipal", require("./components/IndexPrincipal.vue").default)
    .use(router)
    .use(SmartTable)
    .mount("#app");