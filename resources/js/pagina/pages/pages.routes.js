import InicioComponent from './inicio.vue'
import MedidasComponent from './medidas.vue'
import PacienteComponent from './paciente.vue'
import NoticiaComponent from './noticias.vue'
import CovidComponent from './covid.vue'
import AcercaDeComponent from './acercade.vue'
// import axios from "axios";
// Vue.use(VueRouter)listarMenu(){
  let page_routes =
 [
  { path: "inicio", component: InicioComponent, name: 'Inicio' },
  { path: "medida", component: MedidasComponent, name: 'Medida' },
  { path: "paciente", component: PacienteComponent, name: 'Paciente' },
  { path: "noticia", component: NoticiaComponent, name: 'Noticia' },
  { path: "covid", component: CovidComponent, name: 'Covid' },
  { path: "acercade", component: AcercaDeComponent, name: 'Acercade' },
  { path: "", redirect: { name: 'Inicio' }
 },
];
export default page_routes;