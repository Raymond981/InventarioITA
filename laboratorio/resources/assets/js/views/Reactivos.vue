<template>
  <div class='columns is-mobile is-multiline p-t-sm p-r-sm p-l-sm'>
    <div class='column is-12 m-b-md'>
      <top-bar element='reactivos' @open='openCreateModal' @search='search'></top-bar>
    </div>
    <div class='column is-12'>
      <div class="columns is-multiline is-mobile is-centered">
        <element-card class='column is-11 m-b-md' v-for='element in elements' :key='element.id' :element='element' @openDeleteModal='setDeleteModal' @openEditModal='setEditModal'></element-card>
      </div>
    </div>

    <!-- crear -->
    <base-modal :active='active' @close='active=!active'>
      <template slot='modal-content'>
        <form class='columns is-multiline is-mobile m-0 p-t-sm p-l-md p-r-md p-b-md' @submit.prevent='submit' @keydown.enter.prevent='submit'>
          <p class='column is-12 has-text-weight-bold has-text-centered is-size-5 m-none'>Nuevo Reactivo</p>

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
            <label class='label is-size-7-mobile'>Clase</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='$v.element.clase.$model'>
            </div>
            <p class="help is-danger" v-if='$v.element.clase.$error'>Este campo es un número y es requerido</p>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>Estado físico</label>
            <div class="control is-expanded">
              <div class="select is-fullwidth">
                <select v-model='$v.element.estado_fisico.$model'>
                  <option>líquido</option>
                  <option>sólido</option>
                  <option>gaseoso</option>
                  <option>plasma</option>
                </select>
              </div>
            </div>
            <p class="help is-danger" v-if='$v.element.estado_fisico.$error'>Este campo es requerido</p>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>Fórmula química</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Fórmula química del elemento' v-model='$v.element.formula_quimica.$model'>
            </div>
            <p class="help is-danger" v-if='$v.element.formula_quimica.$error'>Este campo es requerido</p>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>No. Piezas</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Número de serie' v-model='$v.element.no_piezas.$model'>
            </div>
            <p class="help is-danger" v-if='$v.element.no_piezas.$error'>Este campo debe ser un entero</p>
          </div>

          <div class="column is-6-tablet is-12-mobile p-b-0 m-b-0">
            <label class='label is-size-7-mobile'>Cantidad</label>
            <div class='field has-addons has-addons-centered'>
              <div class='control is-expanded'>
                <input class='input' placeholder='0' v-model='$v.element.cantidad.$model'>
              </div>
              <p class="control">
                <span class="select">
                  <select v-model='element.unidad_medida'>
                    <option>l</option>
                    <option>ml</option>
                    <option>Kg</option>
                    <option>g</option>
                  </select>
                </span>
              </p>
            </div>
            <p class="help is-danger" v-if='$v.element.cantidad.$error'>Este campo debe ser un número</p>
            <p class="help is-danger" v-if='$v.element.unidad_medida.$error'>Falta la unidad de medida</p>
          </div>

          <div class='field column is-12'>
            <label class='label is-size-7-mobile'>Descripción</label>
            <div class='control'>
              <textarea class='textarea' placeholder='Descripción del elemento' :rows='2' v-model='$v.element.descripcion.$model'></textarea>
            </div>
            <p class="help is-danger" v-if='$v.element.descripcion.$error'>Este campo tiene un máximo de 150 caracteres</p>
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
          <strong>reactivo {{element.nombre}} </strong>
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
          <p class='column is-12 has-text-weight-bold has-text-centered is-size-5 m-none'>Editar reactivo</p>

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
            <label class='label is-size-7-mobile'>Clase</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='$v.element.clase.$model'>
            </div>
            <p class="help is-danger" v-if='$v.element.clase.$error'>Este campo es un número y es requerido</p>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>Estado físico</label>
            <div class="control is-expanded">
              <div class="select is-fullwidth">
                <select v-model='$v.element.estado_fisico.$model'>
                  <option>líquido</option>
                  <option>sólido</option>
                  <option>gaseoso</option>
                  <option>plasma</option>
                </select>
              </div>
            </div>
            <p class="help is-danger" v-if='$v.element.estado_fisico.$error'>Este campo es requerido</p>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>Fórmula química</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Fórmula química del elemento' v-model='$v.element.formula_quimica.$model'>
            </div>
            <p class="help is-danger" v-if='$v.element.formula_quimica.$error'>Este campo es requerido</p>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>No. Piezas</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Número de serie' v-model='$v.element.no_piezas.$model'>
            </div>
            <p class="help is-danger" v-if='$v.element.no_piezas.$error'>Este campo debe ser un entero</p>
          </div>

          <div class="column is-6-tablet is-12-mobile p-b-0 m-b-0">
            <label class='label is-size-7-mobile'>Cantidad</label>
            <div class='field has-addons has-addons-centered'>
              <div class='control is-expanded'>
                <input class='input' placeholder='0' v-model='$v.element.cantidad.$model'>
              </div>
              <p class="control">
                <span class="select">
                  <select v-model='element.unidad_medida'>
                    <option>l</option>
                    <option>ml</option>
                    <option>Kg</option>
                    <option>g</option>
                  </select>
                </span>
              </p>
            </div>
            <p class="help is-danger" v-if='$v.element.cantidad.$error'>Este campo debe ser un número</p>
            <p class="help is-danger" v-if='$v.element.unidad_medida.$error'>Falta la unidad de medida</p>
          </div>

          <div class='field column is-12'>
            <label class='label is-size-7-mobile'>Descripción</label>
            <div class='control'>
              <textarea class='textarea' placeholder='Descripción del elemento' :rows='2' v-model='$v.element.descripcion.$model'></textarea>
            </div>
            <p class="help is-danger" v-if='$v.element.descripcion.$error'>Este campo tiene un máximo de 150 caracteres</p>
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
import { required, integer, maxLength, decimal, or } from "vuelidate/lib/validators";
import axios from 'axios'

  export default {
    name: 'Reactivos',
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
        clase: {
          required,
          integer,
          maxLength: maxLength(4)
        },
        estado_fisico: {
          required,
          maxLength: maxLength(50)
        },
        formula_quimica: {
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
        },
        cantidad: {
          required,
          custom: or(integer, decimal)
        },
        unidad_medida: {
          required
        },
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
        nombre: null,
        descripcion: null,
        clase: null,
        estado_fisico: null,
        formula_quimica: null,
        no_serie: null,
        no_piezas: null,
        cantidad: null,
        unidad_medida: null,
        eliminado: false
      }
    }),
    created () {
      this.getElements()
    },
    methods: {
      getElements () {
        axios.get(`http://127.0.0.1:8000/api/Elements/reactivos`)
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
          axios.post('http://127.0.0.1:8000/api/Elements/reactivos', {
            nombre: this.element.nombre,
            descripcion: this.element.descripcion,
            clase: this.element.clase,
            estado_fisico: this.element.estado_fisico,
            formula_quimica: this.element.formula_quimica,
            no_serie: this.element.no_serie,
            no_piezas: this.element.no_piezas,
            cantidad: this.element.cantidad,
            unidad_medida: this.element.unidad_medida
          })
          .then(response => {
            this.active = false
          })
          .catch( e => {
            console.log(e.response)
          })
        } else {
          console.log("Error en crear reactivo")
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
          axios.put(`http://127.0.0.1:8000/api/Elements/reactivos/${this.element.id}`, {
            nombre: this.element.nombre,
            descripcion: this.element.descripcion,
            clase: this.element.clase,
            estado_fisico: this.element.estado_fisico,
            formula_quimica: this.element.formula_quimica,
            no_serie: this.element.no_serie,
            no_piezas: this.element.no_piezas,
            cantidad: this.element.cantidad,
            unidad_medida: this.element.unidad_medida
          })
          .then(response => {
            this.getElements()
            this.activeEditModal = false
          })
          .catch( e => {
            console.log(e.response)
          })
        } else {
          console.log("Error en editar reactivos")
        }
      },
      openCreateModal () {
        this.initializeElement()
        this.active = !this.active
      },
      setDeleteModal (x) {
        this.initializeElement()
        axios.get(`http://127.0.0.1:8000/api/Elements/reactivos/${x}`)
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
        axios.get(`http://127.0.0.1:8000/api/Elements/reactivos/${x}`)
        .then(response => {
          this.element.id = response.data.data.id
          this.element.nombre = response.data.data.nombre
          this.element.descripcion = response.data.data.descripcion
          this.element.clase = response.data.data.clase
          this.element.estado_fisico = response.data.data.estado_fisico
          this.element.formula_quimica = response.data.data.formula_quimica
          this.element.no_serie = response.data.data.no_serie
          this.element.no_piezas = response.data.data.no_piezas
          this.element.cantidad = response.data.data.cantidad
          this.element.unidad_medida = response.data.data.unidad_medida
          this.activeEditModal = true
        })
        .catch( e => {
          console.log(e)
        })
      },
      initializeElement () {
        this.element.id = null
        this.element.nombre = null
        this.element.descripcion = null
        this.element.estado_fisico = null
        this.element.formula_quimica = null
        this.element.no_serie = null
        this.element.no_piezas = null
        this.element.cantidad = null
        this.element.unidad_medida = null
        this.element.eliminado = null
      },
      search (name) {
        axios.post('http://127.0.0.1:8000/api/Elements/search/reactivo', {
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
