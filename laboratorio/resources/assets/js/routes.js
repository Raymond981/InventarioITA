import Home from './views/Home.vue'
import Elements from './views/Elements.vue'
import Equipos from './views/Equipos.vue'
import Materiales from './views/Materiales.vue'
import Reactivos from './views/Reactivos.vue'

export const routes = [
  {
    path: '/',
    name: 'Elements',
    component: Elements
  },
  {
    path: '/Equipos',
    name: 'Equipos',
    component: Equipos
  },
  {
    path: '/Materiales',
    name: 'Materiales',
    component: Materiales
  },
  {
    path: '/Reactivos',
    name: 'Reactivos',
    component: Reactivos
  }
];