import Home from './views/Home.vue'
import Elements from './views/Elements.vue'

export const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/Elements/:tipo',
    name: 'Elements',
    component: Elements,
    props: true
  }
];