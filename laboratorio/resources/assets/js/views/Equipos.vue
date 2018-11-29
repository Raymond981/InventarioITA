<template>
  <div class='columns is-mobile is-multiline p-t-sm p-r-sm p-l-sm'>
    <div class='column is-12 m-b-md'>
      <top-bar element='equipos' @open='openCreateModal' @search='search'></top-bar>
    </div>
    <div class='column is-12'>
      <div class="columns is-multiline is-mobile is-centered">
        <element-card class='column is-11 m-b-md' v-for='element in elements' :key='element.id' :element='element' @openDeleteModal='setDeleteModal' @openEditModal='setEditModal(element.id)'></element-card>
      </div>
    </div>

    <!-- crear -->
    <base-modal :active='active' @close='active=!active'>
      <template slot='modal-content'>
        <form class='columns is-multiline is-mobile m-0 p-t-sm p-l-md p-r-md p-b-md' @submit.prevent='submit' @keydown.enter.prevent='submit'>
          <p class='column is-12 has-text-weight-bold has-text-centered is-size-5 m-none'>Nuevo Equipo</p>
          
          <div class='field column is-12 p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>Intervalo de mantenimientos</label>
            <div class='control'>
              <v-date-picker mode='multiple' v-model='$v.dates.$model' 
              :input-props='{ class: "input", placeholder: "Seleccione las fechas", readonly: true }'>
              </v-date-picker>
            </div>
            <p class="help is-danger" v-if='$v.dates.$error'>Debe seleccionar por lo menos dos fechas</p>
          </div>

          <div class='field column is-12 p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>Nombre</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='$v.element.nombre.$model'>
            </div>
            <p class="help is-danger" v-if='$v.element.nombre.$error'>Este campo es requerido</p>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>No. Serie</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Número de serie' v-model='$v.element.no_serie.$model'>
            </div>
            <p class="help is-danger" v-if='$v.element.no_serie.$error'>Este campo es requerido</p>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>No. Piezas</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Número de serie' v-model='element.no_piezas'>
            </div>
            <p class="help is-danger" v-if='$v.element.no_piezas.$error'>Este campo debe ser un entero</p>
          </div>

          <div class='field column is-12'>
            <label class='label is-size-7-mobile'>Descripción</label>
            <div class='control'>
              <textarea class='textarea' placeholder='Descripción del elemento' :rows='2' v-model='$v.element.descripcion.$model'></textarea>
            </div>
            <p class="help is-danger" v-if='$v.element.descripcion.$error'>Este campo es de máximo 150 caracteres</p>
          </div>

          <button class="button is-rounded is-fullwidth is-primary">Agregar</button>
        </form>
      </template>
    </base-modal>

    <!-- eliminar -->
    <base-modal :active='activeDeleteModal' @close='activeDeleteModal=!activeDeleteModal'>
      <template slot='modal-content'>
        <div class='delete-modal-top'>
          <div class='circle has-background-danger'>
            <span class='icon is-large has-text-white'>
              <i class='fas fa-3x fa-trash-alt'></i>
            </span>
          </div>
        </div>
        <p class='is-size-5-tablet is-size-6-mobile has-text-centered'>
          ¿Deseas borrar el 
          <strong>Equipo {{element.nombre}} </strong>
           de nuestros registros?
        </p>
        <div class='columns is-mobile is-multiline is-centered m-0'>
          <div class='column is-6 has-text-centered'>
            <span class='button is-rounded is-danger left-button' @click='activeDeleteModal=!activeDeleteModal'>No</span>
          </div>
          <div class='column is-6 has-text-centered'>
            <span class='button is-rounded is-success right-button' @click='deleteElement'>Si</span>
          </div>
        </div>
      </template>
    </base-modal>

    <!-- editar -->
    <base-modal :active='activeEditModal' @close='activeEditModal=!activeEditModal'>
      <template slot='modal-content'>
        <form class='columns is-multiline is-mobile m-0 p-t-sm p-l-md p-r-md p-b-md' @submit.prevent='submitEdit'>
          <p class='column is-12 has-text-weight-bold has-text-centered is-size-5 m-none'>Editar equipo</p>
          
          <div class='field column is-12 p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>Intervalo de mantenimientos</label>
            <div class='control'>
              <v-date-picker mode='multiple' v-model='$v.dates.$model' 
              :input-props='{ class: "input", placeholder: "Seleccione las fechas", readonly: true }'>
              </v-date-picker>
            </div>
            <p class="help is-danger" v-if='$v.dates.$error'>Debe seleccionar por lo menos dos fechas</p>
          </div>

          <div class='field column is-12 p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>Nombre</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='$v.element.nombre.$model'>
            </div>
            <p class="help is-danger" v-if='$v.element.nombre.$error'>Este campo es requerido</p>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>No. Serie</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Número de serie' v-model='$v.element.no_serie.$model'>
            </div>
            <p class="help is-danger" v-if='$v.element.no_serie.$error'>Este campo es requerido</p>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>No. Piezas</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Número de serie' v-model='element.no_piezas'>
            </div>
            <p class="help is-danger" v-if='$v.element.no_piezas.$error'>Este campo debe ser un entero</p>
          </div>

          <div class='field column is-12'>
            <label class='label is-size-7-mobile'>Descripción</label>
            <div class='control'>
              <textarea class='textarea' placeholder='Descripción del elemento' :rows='2' v-model='$v.element.descripcion.$model'></textarea>
            </div>
            <p class="help is-danger" v-if='$v.element.descripcion.$error'>Este campo es de máximo 150 caracteres</p>
          </div>

          <button class="button is-rounded is-fullwidth is-primary">Actualizar</button>
        </form>
      </template>
    </base-modal>
  </div>
</template>

<script>
import TopBar from '../components/TopBar.vue'
import ElementCard from '../components/ElementCard.vue'
import BaseModal from '../components/BaseModal.vue'
import { validationMixin } from "vuelidate";
import { required, integer, maxLength, minLength } from "vuelidate/lib/validators";
import axios from 'axios'

  export default {
    name: 'home',
    mixins: [validationMixin],
    components:{
      TopBar,
      ElementCard,
      BaseModal
    },
    validations: {
      element: {
        nombre: {
          required,
          maxLength: maxLength(100)
        },
        descripcion: {
          required,
          maxLength: maxLength(150)
        },
        no_serie: {
          required,
          maxLength: maxLength(100)
        },
        no_piezas: {
          required,
          integer
        }
      },
      dates: {
        required,
        minLength: minLength(2)
      }
    },
    data: () => ({
      active: false,
      activeDeleteModal: false,
      activeEditModal: false,
      dates: [],
      elements: [],
      element: {
        id: null,
        tipo: null,
        nombre: null,
        descripcion: null,
        no_serie: null,
        no_piezas: null,
        mantenimiento1: null,
        mantenimiento2: null,
        eliminado: false
      }
    }),
    created () {
      this.getElements()
    },
    methods: {
      getElements () {
        axios.get(`http://127.0.0.1:8000/api/Elements/equipos`)
        .then(response => {
          this.elements = response.data.data
        })
        .catch( e => {
          console.log(e)
        })
      },
      submit () {
        this.$v.$touch();
        if (!this.$v.$invalid) {
          this.element.mantenimiento1 = this.dates[0]
          this.element.mantenimiento2 = this.dates[1]
          axios.post('http://127.0.0.1:8000/api/Elements/equipos', {
            nombre: this.$v.element.nombre.$model,
            descripcion: this.$v.element.descripcion.$model,
            no_serie: this.$v.element.no_serie.$model,
            no_piezas: this.$v.element.no_piezas.$model,
            mantenimiento1: this.element.mantenimiento1,
            mantenimiento2: this.element.mantenimiento2
          })
          .then(response => {
            this.active = false
          })
          .catch( e => {
            console.log(e.response)
          })
        }
        this.getElements()
      },
      deleteElement () {
        axios.delete(`http://127.0.0.1:8000/api/Elements/todos/${this.element.id}`)
        .then(response => {
          this.activeDeleteModal = false
          this.getElements()
        })
        .catch( e => {
          console.log(e)
        })
        this.initializeElement
      },
      submitEdit () {
        this.$v.$touch();
        if (!this.$v.$invalid) {
          axios.put(`http://127.0.0.1:8000/api/Elements/equipos/${this.element.id}`, {
            nombre: this.$v.element.nombre.$model,
            descripcion: this.$v.element.descripcion.$model,
            no_serie: this.$v.element.no_serie.$model,
            no_piezas: this.$v.element.no_piezas.$model,
            mantenimiento1: this.element.mantenimiento1,
            mantenimiento2: this.element.mantenimiento2
          })
          .then(response => {
            this.getElements()
            this.activeEditModal = false
          })
          .catch( e => {
            console.log(e.response)
          })
        } else {
          console.log("Error en editar equipo")
        }
      },
      openCreateModal () {
        this.initializeElement()
        this.active = !this.active
      },
      setDeleteModal (x) {
        this.initializeElement()
        axios.get(`http://127.0.0.1:8000/api/Elements/todos/${x}`)
        .then(response => {
          this.element = response.data.data
          this.activeDeleteModal = true
        })
        .catch( e => {
          console.log(e)
        })
      },
      setEditModal (x) {
        this.initializeElement()
        axios.get(`http://127.0.0.1:8000/api/Elements/equipos/${x}`)
        .then(response => {
          this.element.id = response.data.data.id
          this.element.nombre = response.data.data.nombre
          this.element.descripcion = response.data.data.descripcion
          this.element.no_serie = response.data.data.no_serie
          this.element.no_piezas = response.data.data.no_piezas
          this.element.mantenimiento1 = new Date(response.data.data.mantenimiento1)
          this.element.mantenimiento2 = new Date(response.data.data.mantenimiento2)
          this.dates = [this.element.mantenimiento1, this.element.mantenimiento2]
          this.activeEditModal = true
        })
        .catch( e => {
          console.log(e.response)
        })
      },
      initializeElement () {
        this.element.id = null
        this.element.nombre = null
        this.element.descripcion = null
        this.element.no_serie = null
        this.element.no_piezas = null
        this.element.mantenimiento1 = null
        this.element.mantenimiento2 = null
        this.element.eliminado = null
        this.dates = null
      },
      search (name) {
        axios.post('http://127.0.0.1:8000/api/Elements/search/equipo', {
          search: name
        })
        .then(response => {
          this.elements = response.data
        })
        .catch( e => {
          console.log(e.response)
        })
      }
    }
  }
</script>

<style lang="sass" scoped>
  .m-0
    margin: 0 !important
  .p-b-0
    padding-bottom: 0 !important
  .m-b-0
    margin-bottom: 0 !important
  .textarea
    resize: none
  .delete-modal-top
    height: 10em
    display: flex
    justify-content: center
    align-items: center
  .circle
    height: 8em
    width: 8em
    border-radius: 5em
    display: flex
    justify-content: center
    align-items: center
  .left-button
    width: 8em
  .right-button
    width: 8em
</style>
