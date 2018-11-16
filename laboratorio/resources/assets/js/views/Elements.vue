<template>
  <div class='columns is-mobile is-multiline p-t-sm p-r-sm p-l-sm'>
    <div class='column is-12 m-b-md'>
      <top-bar :element="tipo" @open="showModal"></top-bar>
    </div>
    <div class='column is-12'>
      <div class="columns is-multiline is-mobile is-centered">
        <element-card class='column is-11 m-b-md' v-for='element in elements' :key='element.id' :element='element'></element-card>
      </div>
    </div>

    <base-modal :active='active' @close='active=!active'>
      <template slot='modal-content'>
        <form class='columns is-multiline is-mobile' @submit.prevent='submit'>
          <p class='column is-12 has-text-weight-bold has-text-centered is-size-5 m-none'>Nuevo {{tipo}}</p>
          
          <div class='field column is-12' v-if="tipo==='equipos'">
            <label class='label is-size-7-mobile'>Intervalo de mantenimientos</label>
            <div class='control'>
              <v-date-picker mode='multiple' v-model='dates' 
              :input-props='{ class: "input", placeholder: "Seleccione las fechas", readonly: true }'>
              </v-date-picker>
            </div>
          </div>

          <div class='field column is-12'>
            <label class='label is-size-7-mobile'>Nombre</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='element.nombre'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile'>
            <label class='label is-size-7-mobile'>No. Serie</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Número de serie' v-model='element.no_serie'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile'>
            <label class='label is-size-7-mobile'>Clase</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='element.clase'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile'>
            <label class='label is-size-7-mobile'>Estado físico</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='element.estado_fisico'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile'>
            <label class='label is-size-7-mobile'>Fórmula química</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='element.formula_quimica'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile'>
            <label class='label is-size-7-mobile'>No. Piezas</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Número de serie' v-model='element.no_piezas'>
            </div>
          </div>

          <div class="column is-6-tablet is-12-mobile">
            <label class='label is-size-7-mobile'>Cantidad</label>
            <div class='field has-addons has-addons-centered'>
              <div class='control is-expanded'>
                <input class='input' type='number' placeholder='0' v-model='element.cantidad'>
              </div>
              <p class="control">
                <span class="select">
                  <select v-model='element.unidad_medida'>
                    <option>L</option>
                    <option>ml</option>
                    <option>Kg</option>
                    <option>g</option>
                  </select>
                </span>
              </p>
            </div>
          </div>

          <div class='field column is-12'>
            <label class='label is-size-7-mobile'>Descripción</label>
            <div class='control'>
              <textarea class='textarea' placeholder='Descripción del elemento' :rows='2' v-model='element.descripcion'></textarea>
            </div>
            <p class='help has-text-right has-text-primary'>150</p>
          </div>

          <a class="button is-rounded is-fullwidth is-primary">Agregar</a>
        </form>
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
    data: () => ({
      active: false,
      modalTodo: false,
      modalEquipo: false,
      modalMaterial: false,
      modalReactivo: false,
      dates: [],
      elements: [],
      tipo: '',
      element: {
        tipo: null,
        nombre: null,
        descripcion: null,
        clase: null,
        estado_fisico: null,
        formula_quimica: null,
        no_serie: null,
        no_piezas: null,
        cantidad: null,
        unidad_medida: null,
        mantenimiento1: null,
        mantenimiento2: null,
        eliminado: false
      }
    }),
    created () {
      this.$store.$on('todo', () => {
        this.tipo = 'todo'
        this.getElements()
      })
      this.$store.$on('equipos', () => {
        this.tipo = 'equipos'
        this.getElements()
      })
      this.$store.$on('materiales', () => {
        this.tipo = 'materiales'
        this.getElements()
      })
      this.$store.$on('reactivos', () => {
        this.tipo = 'reactivos'
        this.getElements()
      })
    },
    methods: {
      getElements () {
        axios.get(`http://localhost:8000/api/Elements/${this.tipo}`)
        .then(response => {
          this.elements = response.data.data
        })
        .catch( e => {
          console.log(e)
        })
      },
      showModal () {
        this.active = true
        switch (this.tipo) {
          case 'todo':
            this.modalTodo = true
            break
          case 'equipos':
            this.modalEquipo = true
            break
          case 'materiales':
            this.modalMaterial = true
            break
          case 'reactivos':
            this.modalReactivo = true
            break
          default:
            break
        }
      },
      submit () {
        axios.get('http://localhost:8000/api/reactivos').then(({data})=>{
          console.log(data)
        })
        this.getElements()
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
