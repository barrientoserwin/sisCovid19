import InicioComponent from './inicio.vue'
import MedidasComponent from './medidas.vue'
// import axios from "axios";
// Vue.use(VueRouter)listarMenu(){
  let page_routes =
 [
  { path: "inicio", component: InicioComponent, name: 'Inicio' },
  { path: "medida", component: MedidasComponent, name: 'Medida' },
  { path: "", redirect: { name: 'Inicio' }
 },
];
export default page_routes;