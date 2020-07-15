
import Vue from 'vue';
import VueRouter from 'vue-router'
import pages_router from '../pagina/pages/pages.routes.js'

import pages_component from '../pagina/pages/pages.vue'
import error from "../pagina/shared/error.vue";

Vue.use(VueRouter)

const routes = [
  { path: "/", component:pages_component,
    children: pages_router },
  { path: "**", component: error }
];

const app_router = new VueRouter({
mode: 'hash',
routes,
  
});

export default app_router;