<template>
  <div class='columns is-mobile is-multiline p-t-sm p-r-sm p-l-sm'>
    <div class='column is-12'>
      <top-bar></top-bar>
    </div>
    <div class='column is-12'>
      <p class='is-size-2 has-text-centered has-text-weight-semibold has-text-success'>Dashboard</p>
    </div>
  </div>
</template>

<script>
import TopBar from '../components/TopBar.vue'

  export default {
    name: 'home',
    components:{
      TopBar
    }
  }
</script>
