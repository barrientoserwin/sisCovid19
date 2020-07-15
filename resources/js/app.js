/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('frm-paciente', require('./components/frmPaciente.vue').default);
Vue.component('frm-hospital', require('./components/frmHospital.vue').default);
Vue.component('frm-rol', require('./components/frmRol.vue').default);
Vue.component('frm-usuario', require('./components/frmUsuario.vue').default);
Vue.component('frm-medicamento', require('./components/frmMedicamento.vue').default);
Vue.component('frm-sintoma', require('./components/frmSintoma.vue').default);
Vue.component('frm-analisis', require('./components/frmAnalisis.vue').default);


const app = new Vue({
    el: '#app',
    data : {
        menu : 0
    }
});

