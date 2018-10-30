<template>
  <div>
    <navigation-drawer @toggleDrawer='isActive=!isActive'></navigation-drawer>
    <div :class='[{ "open-margin": isActive }, "content"]'>
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import NavigationDrawer from '../components/NavigationDrawer.vue'

  export default {
    name: 'main-app',
    components: {
      NavigationDrawer
    },
    data: () => ({
      isActive: false
    }),
    methods: {
    }
  }
</script>

<style lang='sass' scoped>
  .content
    margin-left: 3.5rem
    transition: margin-left .5s
  .open-margin
    margin-left: 10rem
</style>
