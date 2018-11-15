<template>
  <div class='columns is-mobile is-multiline p-t-sm p-r-sm p-l-sm'>
    <div class='column is-12 m-b-md'>
      <top-bar :element="tipo" @open="active=!active"></top-bar>
    </div>
    <div class='column is-12'>
      <div class="columns is-multiline is-mobile is-centered">
        <element-card class='column is-11 m-b-md' v-for='element in elements' :key='element.id' :element='element'></element-card>
      </div>
    </div>

    <base-modal :active="active" @close="active=!active">
      <template slot="modal-content">
        
        <p class="column is-12 has-text-weight-bold has-text-centered is-size-5 m-none">Nuevo {{tipo}}</p>
        
        <div class="column is-12 field m-none" v-if="tipo==='equipo'">
          <label class="label is-size-7-mobile">Intervalo de mantenimientos</label>
          <div class="control">
            <v-date-picker mode='multiple' v-model='dates' 
            :input-props='{ class: "input", placeholder: "Seleccione las fechas", readonly: true }'>
            </v-date-picker>
          </div>
        </div>

        <div class="column is-12 field m-none p-b-0">
          <label class="label is-size-7-mobile">Nombre</label>
          <div class="control">
            <input class="input" type="text" placeholder="Nombre del elemento">
          </div>
        </div>

        <div class="column is-6-tablet is-12-mobile field m-none p-b-0">
          <label class="label is-size-7-mobile">No. Serie</label>
          <div class="control">
            <input class="input" type="text" placeholder="Número de serie">
          </div>
        </div>

        <div class="column is-6-tablet is-12-mobile m-none p-b-0">
          <label class="label is-size-7-mobile">Cantidad</label>
          <div class="field has-addons has-addons-centered">
            <div class="control is-expanded">
              <input class="input" type="number" placeholder="0">
            </div>
            <p class="control">
              <span class="select">
                <select>
                  <option>L</option>
                  <option>ml</option>
                  <option>Kg</option>
                  <option>g</option>
                  <option>pieza</option>
                </select>
              </span>
            </p>
          </div>
        </div>

        <div class="column is-12 field m-none p-b-0">
          <label class="label is-size-7-mobile">Descripción</label>
          <div class="control">
            <textarea class="textarea" placeholder="Descripción del elemento" :rows="2"></textarea>
          </div>
          <p class="help has-text-right has-text-primary">150</p>
        </div>

        <div class="column is-12 field m-none p-b-0" v-if="tipo==='reactivos'">
          <label class="label is-size-7-mobile">Riesgos</label>
          <div class="control">
            <textarea class="textarea" placeholder="Descripción del elemento" :rows="2"></textarea>
          </div>
          <p class="help has-text-right has-text-primary">150</p>
        </div>

        <a class="button is-rounded" @click="toto">Agregar</a>
      </template>
    </base-modal>
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
        dates: [],
        elements: [
          {id:1, nombre:'Elemento 1', descripcion:'Lorem ipsum dolor sit amet consectetur adipiscing elit, litora lacus commodo curae hac dignissim porta, cum luctus netus laoreet fames semper. Quam id dictum ultrices velit magna est tempus ridiculus.', cantidad:12, mantenimiento: false },
          {id:2, nombre:'Elemento 2', descripcion:'Lorem ipsum dolor sit amet consectetur adipiscing elit, litora lacus commodo curae hac dignissim porta, cum luctus netus laoreet fames semper. Quam id dictum ultrices velit magna est tempus ridiculus.', cantidad:2, mantenimiento: false },
          {id:3, nombre:'Elemento 3', descripcion:'Lorem ipsum dolor sit amet consectetur adipiscing elit, litora lacus commodo curae hac dignissim porta, cum luctus netus laoreet fames semper. Quam id dictum ultrices velit magna est tempus ridiculus.', cantidad:15, mantenimiento: false },
          {id:4, nombre:'Elemento 4', descripcion:'Lorem ipsum dolor sit amet consectetur adipiscing elit, litora lacus commodo curae hac dignissim porta, cum luctus netus laoreet fames semper. Quam id dictum ultrices velit magna est tempus ridiculus.', cantidad:20, mantenimiento: true },
          {id:5, nombre:'Elemento 5', descripcion:'Lorem ipsum dolor sit amet consectetur adipiscing elit, litora lacus commodo curae hac dignissim porta, cum luctus netus laoreet fames semper. Quam id dictum ultrices velit magna est tempus ridiculus.', cantidad:40, mantenimiento: false }
        ]
      }
    },
    methods: {
      toto(){
        axios.get('http://localhost:8000/api/reactivos').then(({data})=>{
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
