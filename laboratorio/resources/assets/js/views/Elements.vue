<template>
  <div class='columns is-mobile is-multiline p-t-sm p-r-sm p-l-sm'>
    <div class='column is-12 m-b-md'>
      <top-bar :element="tipo"></top-bar>
    </div>
    <div class='column is-12'>
      <div class="columns is-multiline is-mobile is-centered">
        <element-card :mantenimiento="false"></element-card>
        <element-card :mantenimiento="true"></element-card>
      </div>
    </div>
  </div>
</template>

<script>
import TopBar from '../components/TopBar.vue'
import ElementCard from '../components/ElementCard.vue'

  export default {
    name: 'home',
    components:{
      TopBar,
      ElementCard
    },
    props: {
      tipo: {
        type: String,
        required: true
      }
    }
  }
</script>

