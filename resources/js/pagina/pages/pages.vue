<template>
  <div>
    <app-header></app-header>
    <app-nav></app-nav>
    <router-view></router-view>
    <app-noticias></app-noticias>
    <app-footer></app-footer>
  </div>
</template>
<script>
import Header from "../shared/header.vue";
import Nav from "../shared/nav.vue";
import Noticia from '../shared/noticias.vue'
import Footer from '../shared/footer.vue'

export default {
  components: {
    "app-header": Header,
    "app-nav": Nav,
    "app-footer": Footer,
    "app-noticias": Noticia,
  }
};
</script>