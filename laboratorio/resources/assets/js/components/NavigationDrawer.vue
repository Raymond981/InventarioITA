<template>
  <aside :class='[{ "open": isActive }, "menu p-l-xs"]'>
    <ul class='menu-list'>
      <li class='has-text-white has-text-weight-semibold menu-header p-l-sm is-flex' @click="toggleDrawer">
        <span class='icon is-medium m-r-sm'><i class='fas fa-lg fa-x-ray'></i></span>
        <transition name='fade'>
          <span v-if='isActive'>ITA</span>
        </transition>
      </li>
    </ul>
    
    <router-link :to="{ name: 'Elements', params: { tipo: 'todo' }}" class='menu-label has-text-white p-t-lg m-b-lg'>
      Inventario
    </router-link>
    <ul class='menu-list'>
      <li><router-link :to="{ name: 'Elements', params: { tipo: 'reactivos' }}">
        <span class='icon is-small m-r-sm'><i class='fas fa-lg fa-spa'></i></span>
        <transition name='fade'>
          <span v-if='isActive'>Reactivos</span>
        </transition>
      </router-link></li>
      
      <li><router-link :to="{ name: 'Elements', params: { tipo: 'materiales' }}">
        <span class='icon is-small m-r-sm'><i class='fas fa-lg fa-bong'></i></span>
        <transition name='fade'>
          <span v-if='isActive'>Materiales</span>
        </transition>
      </router-link></li>
      <li><router-link :to="{ name: 'Elements', params: { tipo: 'equipo' }}">
        <span class='icon is-small m-r-sm'><i class='fas fa-lg fa-briefcase'></i></span>
        <transition name='fade'>
          <span v-if='isActive'>Equipo</span>
        </transition>
      </router-link></li>
    </ul>
  </aside>
</template>

<script>

  export default {
    name: 'main-app',
    data: () => ({
      isActive: false
    }),
    methods: {
      toggleDrawer () {
        this.isActive= !this.isActive
        this.$emit('toggleDrawer')
        // this.$router.push({ path: '/' })
      }
    }
  }
</script>

<style lang='sass' scoped>
  .menu
    background-color: #313e50
    height: 100%
    width: 3.5rem
    position: fixed
    z-index: 1
    top: 0
    left: 0
    overflow-x: hidden
    transition: 0.5s

  .menu-list a, .menu-label
    white-space: nowrap
    color: #f2faff
    padding-bottom: .5rem
    padding-top: .5rem
  
  .menu-header
    white-space: nowrap
    height: 8vh
    justify-content: flex-start
    align-items: center
  
  .open
    width: 10rem

  @media screen and (max-height: 450px)
    .menu {padding-top: 15px}

  .fade-enter-active, .fade-leave-active 
    transition: all 0.5s ease
  .fade-enter, .fade-leave-to
    opacity: 0
</style>
