import Vue from 'vue'
import Router from 'vue-router'

import Dashboard from '../components/ExampleComponent'
Vue.use(Router)

let router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Dashboard',
      component: Dashboard
      // beforeEnter: Guard.auth
    },
    // {
    //   path: '/LoginAdmin',
    //   name: 'LoginAdmin',
    //   component: LoginAdmin,
    //   beforeEnter: Guard.guest
    // },
    // {
    //   path: '/Login',
    //   name: 'Login',
    //   component: Login,
    //   beforeEnter: Guard.guest
    // },
    // {
    //   path: '/SignUp',
    //   name: 'SignUp',
    //   component: SignUp,
    //   beforeEnter: Guard.admin
    // },
    // {
    //   path: '/UsuariosChatbot',
    //   name: 'UsuariosChatbot',
    //   component: UsuariosChatbot,
    //   beforeEnter: Guard.auth
    // },
    // {
    //   path: '/Mensajes',
    //   name: 'Mensajes',
    //   component: Mensajes,
    //   beforeEnter: Guard.auth
    // },
    // {
    //   path: '/Intents',
    //   name: 'Intents',
    //   component: Intents,
    //   beforeEnter: Guard.auth
    // },
    // {
    //   path: '/Errores',
    //   name: 'Errores',
    //   component: Errores,
    //   beforeEnter: Guard.auth
    // },
    // {
    //   path: '/Labels',
    //   name: 'Labels',
    //   component: Labels,
    //   beforeEnter: Guard.auth
    // },
    {
      path: '*',
      name: 'NotFound',
      component: NotFound
    }
  ]
})

export default router
