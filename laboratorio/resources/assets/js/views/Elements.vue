<template>
  <div class='columns is-mobile is-multiline p-t-sm p-r-sm p-l-sm'>
    <div class='column is-12 m-b-md'>
      <top-bar :element='tipo' @open='openCreateModal' @search='search'></top-bar>
    </div>
    <div class='column is-12'>
      <div class="columns is-multiline is-mobile is-centered">
        <element-card class='column is-11 m-b-md' v-for='element in elements' :key='element.id' :element='element' @openDeleteModal='setDeleteModal' @openEditModal='setEditModal'></element-card>
      </div>
    </div>

    <!-- crear -->
    <base-modal :active='active' @close='active=!active'>
      <template slot='modal-content'>
        <form class='columns is-multiline is-mobile m-0 p-t-sm p-l-md p-r-md p-b-md' @submit.prevent='submit'>
          <p class='column is-12 has-text-weight-bold has-text-centered is-size-5 m-none'>Nuevo {{tipo}}</p>
          
          <div class='field column is-12 p-b-0 m-b-0' v-if="tipo==='equipos'">
            <label class='label is-size-7-mobile'>Intervalo de mantenimientos</label>
            <div class='control'>
              <v-date-picker mode='multiple' v-model='dates' 
              :input-props='{ class: "input", placeholder: "Seleccione las fechas", readonly: true }'>
              </v-date-picker>
            </div>
          </div>

          <div class='field column is-12 p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>Nombre</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='element.nombre'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>No. Serie</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Número de serie' v-model='element.no_serie'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0' v-if="tipo==='reactivos'">
            <label class='label is-size-7-mobile'>Clase</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='element.clase'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0' v-if="tipo==='reactivos'">
            <label class='label is-size-7-mobile'>Estado físico</label>
            <div class="control is-expanded">
              <div class="select is-fullwidth">
                <select v-model='element.estado_fisico'>
                  <option>líquido</option>
                  <option>sólido</option>
                  <option>gaseoso</option>
                  <option>plasma</option>
                </select>
              </div>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0' v-if="tipo==='reactivos'">
            <label class='label is-size-7-mobile'>Fórmula química</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='element.formula_quimica'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>No. Piezas</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Número de serie' v-model='element.no_piezas'>
            </div>
          </div>

          <div class="column is-6-tablet is-12-mobile p-b-0 m-b-0" v-if="tipo==='reactivos'">
            <label class='label is-size-7-mobile'>Cantidad</label>
            <div class='field has-addons has-addons-centered'>
              <div class='control is-expanded'>
                <input class='input' type='number' placeholder='0' v-model='element.cantidad'>
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
          </div>

          <div class='field column is-12 p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>Descripción</label>
            <div class='control'>
              <textarea class='textarea' placeholder='Descripción del elemento' :rows='2' v-model='element.descripcion'></textarea>
            </div>
            <p class='help has-text-right has-text-primary'>150</p>
          </div>

          <button class="button is-rounded is-fullwidth is-primary">Agregar</button>
        </form>
      </template>
    </base-modal>

    <!-- eliminar -->
    <base-modal :active='activeDeleteModal' @close='activeDeleteModal=!activeDeleteModal'>
      <template slot='modal-content'>
        <p>¿Deseas borrar el {{element.tipo}} {{element.nombre}} permanentemente de nuestros registros?</p>
        <button class='button is-rounded is-primary' @click='activeDeleteModal=!activeDeleteModal'>No</button>
        <button class='button is-rounded is-primary' @click='deleteElement'>Si</button>
      </template>
    </base-modal>

    <!-- editar -->
    <base-modal :active='activeEditModal' @close='activeEditModal=!activeEditModal'>
      <template slot='modal-content'>
        <form class='columns is-multiline is-mobile m-0 p-t-sm p-l-md p-r-md p-b-md' @submit.prevent='submitEdit'>
          <p class='column is-12 has-text-weight-bold has-text-centered is-size-5 m-none'>Editar {{element.tipo}}</p>
          
          <div class='field column is-12 p-b-0 m-b-0' v-if="element.tipo==='equipo'">
            <label class='label is-size-7-mobile'>Intervalo de mantenimientos</label>
            <div class='control'>
              <v-date-picker mode='multiple' v-model='dates' 
              :input-props='{ class: "input", placeholder: "Seleccione las fechas", readonly: true }'>
              </v-date-picker>
            </div>
          </div>

          <div class='field column is-12 p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>Nombre</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='element.nombre'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>No. Serie</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Número de serie' v-model='element.no_serie'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0' v-if="element.tipo==='reactivo'">
            <label class='label is-size-7-mobile'>Clase</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='element.clase'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0' v-if="element.tipo==='reactivo'">
            <label class='label is-size-7-mobile'>Estado físico</label>
            <div class="control is-expanded">
              <div class="select is-fullwidth">
                <select v-model='element.estado_fisico'>
                  <option>líquido</option>
                  <option>sólido</option>
                  <option>gaseoso</option>
                  <option>plasma</option>
                </select>
              </div>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0' v-if="element.tipo==='reactivo'">
            <label class='label is-size-7-mobile'>Fórmula química</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Nombre del elemento' v-model='element.formula_quimica'>
            </div>
          </div>

          <div class='field column is-6-tablet is-12-mobile p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>No. Piezas</label>
            <div class='control'>
              <input class='input' type='text' placeholder='Número de serie' v-model='element.no_piezas'>
            </div>
          </div>

          <div class="column is-6-tablet is-12-mobile p-b-0 m-b-0" v-if="element.tipo==='reactivo'">
            <label class='label is-size-7-mobile'>Cantidad</label>
            <div class='field has-addons has-addons-centered'>
              <div class='control is-expanded'>
                <input class='input' type='number' placeholder='0' v-model='element.cantidad'>
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
          </div>

          <div class='field column is-12 p-b-0 m-b-0'>
            <label class='label is-size-7-mobile'>Descripción</label>
            <div class='control'>
              <textarea class='textarea' placeholder='Descripción del elemento' :rows='2' v-model='element.descripcion'></textarea>
            </div>
            <p class='help has-text-right has-text-primary'>150</p>
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
      activeDeleteModal: false,
      activeEditModal: false,
      dates: [],
      elements: [],
      tipo: 'todos',
      element: {
        id: null,
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
      this.getElements()
      this.$store.$on('todos', () => {
        this.tipo = 'todos'
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
      submit () {
        switch (this.tipo) {
          case 'todos':
            break
          case 'equipos':
            this.element.mantenimiento1 = this.dates[0]
            this.element.mantenimiento2 = this.dates[1]
            axios.post('http://localhost:8000/api/Elements/equipos', {
              nombre: this.element.nombre,
              descripcion: this.element.descripcion,
              no_serie: this.element.no_serie,
              no_piezas: this.element.no_piezas,
              mantenimiento1: this.element.mantenimiento1,
              mantenimiento2: this.element.mantenimiento2
            })
            .then(response => {
              this.active = false
            })
            .catch( e => {
              console.log(e.response)
            })
            break
          case 'reactivos':
            axios.post('http://localhost:8000/api/Elements/reactivos', {
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
            break
          case 'materiales':
            axios.post('http://localhost:8000/api/Elements/materiales', {
              nombre: this.element.nombre,
              descripcion: this.element.descripcion,
              no_serie: this.element.no_serie,
              no_piezas: this.element.no_piezas
            })
            .then(response => {
              this.active = false
            })
            .catch( e => {
              console.log(e.response)
            })
            break
        
          default:
            break;
        }
        this.getElements()
      },
      deleteElement () {
        axios.delete(`http://localhost:8000/api/Elements/todos/${this.element.id}`)
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
        switch (this.element.tipo) {
          case 'reactivo':
            axios.put(`http://localhost:8000/api/Elements/reactivos/${this.element.id}`, {
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
            break
          case 'material':
            axios.put(`http://localhost:8000/api/Elements/materiales/${this.element.id}`, {
              nombre: this.element.nombre,
              descripcion: this.element.descripcion,
              no_serie: this.element.no_serie,
              no_piezas: this.element.no_piezas
            })
            .then(response => {
              this.getElements()
              this.activeEditModal = false
            })
            .catch( e => {
              console.log(e.response)
            })
            break
          case 'equipo':
            axios.put(`http://localhost:8000/api/Elements/equipos/${this.element.id}`, {
              nombre: this.element.nombre,
              descripcion: this.element.descripcion,
              no_serie: this.element.no_serie,
              no_piezas: this.element.no_piezas,
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
            break
        
          default:
            break;
        }
      },
      openCreateModal () {
        this.initializeElement()
        this.active = !this.active
      },
      setDeleteModal (x) {
        this.initializeElement()
        axios.get(`http://localhost:8000/api/Elements/todos/${x}`)
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
        axios.get(`http://localhost:8000/api/Elements/todos/${x}`)
        .then(response => {
          this.element.tipo = response.data.data.tipo
          this.element.id = response.data.data.id
          switch (this.element.tipo) {
            case 'equipo':
              this.element.nombre = response.data.data.nombre
              this.element.descripcion = response.data.data.descripcion
              this.element.no_serie = response.data.data.no_serie
              this.element.no_piezas = response.data.data.no_piezas
              this.element.mantenimiento1 = new Date(response.data.data.mantenimiento1)
              this.element.mantenimiento2 = new Date(response.data.data.mantenimiento2)
              break
            case 'material':
              this.element.nombre = response.data.data.nombre
              this.element.descripcion = response.data.data.descripcion
              this.element.no_serie = response.data.data.no_serie
              this.element.no_piezas = response.data.data.no_piezas
              break
            case 'reactivo':
              this.element.nombre = response.data.data.nombre
              this.element.descripcion = response.data.data.descripcion
              this.element.clase = response.data.data.clase
              this.element.estado_fisico = response.data.data.estado_fisico
              this.element.formula_quimica = response.data.data.formula_quimica
              this.element.no_serie = response.data.data.no_serie
              this.element.no_piezas = response.data.data.no_piezas
              this.element.cantidad = response.data.data.cantidad
              this.element.unidad_medida = response.data.data.unidad_medida
              break
            default:
              break
          }
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
        this.element.mantenimiento1 = null
        this.element.mantenimiento2 = null
        this.element.eliminado = null
      },
      search (name) {
        console.log(name)
        axios.post('http://localhost:8000/api/Elements/search', {
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
</style>
