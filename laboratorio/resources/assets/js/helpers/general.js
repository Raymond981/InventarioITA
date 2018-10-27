export function initialize(router) {
  router.beforeEach((to, from, next) => {
      //const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
      //const currentUser = store.state.currentUser;
  
      if(false ) {
          next('/login');
      } else if(to.path == '/login') {
          next('/');
      } else {
          next();
      }
  });
  
  axios.interceptors.response.use(null, (error) => {
      if (error.resposne.status == 401) {
          store.commit('logout');
          router.push('/login');
      }

      return Promise.reject(error);
  });

  if (false) {
      setAuthorization(store.getters.currentUser.token);
  }
}

export function setAuthorization(token) {
  axios.defaults.headers.common["Authorization"] = `Bearer ${token}`
}