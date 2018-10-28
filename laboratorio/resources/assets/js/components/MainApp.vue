<template>
  <div>
    <aside :class='[{ "open": isActive }, "menu p-l-xs"]'>
      <ul class='menu-list'>
        <li class='has-text-white menu-header p-l-sm is-flex' @click='isActive=!isActive'>
          <span class='icon is-medium m-r-sm'><i class='fas fa-lg fa-x-ray'></i></span>
          <transition name='fade'>
            <span v-if='isActive'>ITA</span>
          </transition>
        </li>
      </ul>
      
      <a class='menu-label has-text-white p-t-lg m-b-lg'>
        <span>Inventario</span>
      </a>
      <ul class='menu-list'>
        <li><a>
          <span class='icon is-small m-r-sm'><i class='fas fa-lg fa-spa'></i></span>
          <transition name='fade'>
            <span v-if='isActive'>Reactivos</span>
          </transition>
        </a></li>
        <li><a>
          <span class='icon is-small m-r-sm'><i class='fas fa-lg fa-bong'></i></span>
          <transition name='fade'>
            <span v-if='isActive'>Materiales</span>
          </transition>
        </a></li>
        <li><a>
          <span class='icon is-small m-r-sm'><i class='fas fa-lg fa-briefcase'></i></span>
          <transition name='fade'>
            <span v-if='isActive'>Equipo</span>
          </transition>
        </a></li>
      </ul>
    </aside>

    <div :class='[{ "open-margin": isActive }, "content"]'>
      <router-view></router-view>
    </div>
  </div>
</template>

<script>

  export default {
    name: 'main-app',
    data: () => ({
      isActive: false
    }),
    methods: {
    }
  }
</script>

<style lang='sass' scoped>
  body
    font-family: 'Lato', sans-serif

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

  .content
    height: 120vh
    margin-left: 3.5rem
    transition: margin-left .5s
  
  .open
    width: 10rem
  
  .open-margin
    margin-left: 10rem
  
  @media screen and (max-height: 450px)
    .menu {padding-top: 15px}

  .fade-enter-active, .fade-leave-active 
    transition: all 0.5s ease
  .fade-enter, .fade-leave-to
    opacity: 0
</style>
