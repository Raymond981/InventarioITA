<template>
  <div class='columns is-mobile is-multiline p-t-sm p-r-sm p-l-sm'>
    <div class='column is-12 m-b-md'>
      <top-bar :element="tipo" @open="active=!active"></top-bar>
      <base-modal :active="active" @close="active=!active">
        <template slot="modal-content">
          <p class="column is-12 has-text-weight-bold has-text-centered is-size-5 m-none">Nuevo registro</p>
          <div class="column is-12 field m-none p-b-0">
            <label class="label is-size-7-mobile">Nombre</label>
            <div class="control">
              <input class="input" type="text" placeholder="Nombre del elemento">
            </div>
          </div>
          <div class="column is-12 field m-none p-b-0">
            <label class="label is-size-7-mobile">Descripción</label>
            <div class="control">
              <textarea class="textarea" placeholder="Descripción del elemento" :rows="2"></textarea>
            </div>
            <p class="help has-text-right has-text-primary">150</p>
          </div>
          <div class="column is-6-tablet is-12-mobile field m-none p-b-0">
            <label class="label is-size-7-mobile">No. Serie</label>
            <div class="control">
              <input class="input" type="text" placeholder="Número de serie">
            </div>
          </div>
          <div class="column is-6-tablet is-12-mobile field m-none p-b-0">
            <label class="label is-size-7-mobile">Cantidad</label>
            <div class="control">
              <input class="input" type="number" placeholder="0">
            </div>
          </div>
          <div class="column is-12 field m-none">
            <label class="label is-size-7-mobile">Intervalo de mantenimientos</label>
            <p class="control has-icons-left is-expanded">
              <span class="select is-fullwidth">
                <select>
                  <option selected>Mensualmente</option>
                  <option>Select dropdown</option>
                  <option>With options</option>
                </select>
              </span>
              <span class="icon is-small is-left">
                <i class="fas fa-globe"></i>
              </span>
            </p>
          </div>
          <a class="button is-rounded" @click="toto">Agregar</a>
        </template>
      </base-modal>
    </div>
    <div class='column is-12'>
      <div class="columns is-multiline is-mobile is-centered">
        <element-card v-for="element in elements" :key="element.id" :element="element" class="column is-11 m-b-md" :mantenimiento="false" :cantidad="12" nombre="ASAS 1" descripcion="Lorem ipsum dolor sit amet consectetur adipiscing elit, litora lacus commodo curaekkkk hac dignissim porta, cum luctus netus laoreet fames semper. Quam id dictum ultrices velit magna est tempus ridiculus."></element-card>
      </div>
    </div>
  </div>
</template>

<script>
import TopBar from '../components/TopBar.vue'
import ElementCard from '../components/ElementCard.vue'
import BaseModal from '../components/BaseModal.vue'
import axios from 'axios'

  export default {
    name: 'home',
    components:{
      TopBar,
      ElementCard,
      BaseModal
    },
    props: {
      tipo: {
        type: String,
        required: true
      }
    },
    data () {
      return {
        active: false,
      }
    },
    methods: {
      toto(){
        axios.get('http://localhost:8001/api/reactivos').then(({data})=>{
          console.log(data)
        })
      }
    }
  }
</script>

<style lang="sass" scoped>
  .p-b-0
    padding-bottom: 0 !important
  .textarea
    resize: none
</style>
