<template>
  <div class="columns is-mobile is-multiline p-t-sm p-r-sm p-l-sm">
    <div class="column is-12 m-b-md">
      <top-bar element="Materiales" @open="openCreateModal" @search="search"></top-bar>
    </div>
    <div class="column is-12">
      <div class="columns is-multiline is-mobile is-centered">
        <element-card
          class="column is-11 m-b-md"
          v-for="element in elements"
          :key="element.id"
          :element="element"
          @openDeleteModal="setDeleteModal"
          @openEditModal="setEditModal"
        ></element-card>
      </div>
    </div>

    <!-- crear -->
    <base-modal :active="active" @close="active=!active">
      <template slot="modal-content">
        <form
          class="columns is-multiline is-mobile m-0 p-t-sm p-l-md p-r-md p-b-md"
          @submit.prevent="submit"
          @keydown.enter.prevent="submit"
        >
          <p
            class="column is-12 has-text-weight-bold has-text-centered is-size-5 m-none"
          >Nuevo material</p>

          <div class="field column is-12 p-b-0 m-b-0">
            <label class="label is-size-7-mobile">Nombre</label>
            <div class="control">
              <input
                class="input"
                type="text"
                placeholder="Nombre del elemento"
                v-model="$v.element.nombre.$model"
              >
            </div>
            <p class="help is-danger" v-if="$v.element.nombre.$error">Este campo es requerido</p>
          </div>

          <div class="field column is-6-tablet is-12-mobile p-b-0 m-b-0">
            <label class="label is-size-7-mobile">No. Serie</label>
            <div class="control">
              <input
                class="input"
                type="text"
                placeholder="Número de serie"
                v-model="$v.element.no_serie.$model"
              >
            </div>
            <p class="help is-danger" v-if="$v.element.no_serie.$error">Este campo es requerido</p>
          </div>

          <div class="field column is-6-tablet is-12-mobile p-b-0 m-b-0">
            <label class="label is-size-7-mobile">No. Piezas</label>
            <div class="control">
              <input
                class="input"
                type="text"
                placeholder="Número de serie"
                v-model="$v.element.no_piezas.$model"
              >
            </div>
            <p
              class="help is-danger"
              v-if="$v.element.no_piezas.$error"
            >Este campo debe ser un número entero</p>
          </div>

          <div class="field column is-12 p-b-0 m-b-0">
            <label class="label is-size-7-mobile">Descripción</label>
            <div class="control">
              <textarea
                class="textarea"
                placeholder="Descripción del elemento"
                :rows="2"
                v-model="$v.element.descripcion.$model"
                @input="$v.element.descripcion.$touch()"
              ></textarea>
            </div>
            <p
              class="help is-danger"
              v-if="$v.element.descripcion.$error"
            >El número de caracteres máximos es de 150, este campo debe llenarse</p>
            <p class="help has-text-right has-text-primary">150</p>
          </div>

          <button class="button is-rounded is-fullwidth is-primary">Agregar</button>
        </form>
      </template>
    </base-modal>

    <!-- eliminar -->
    <base-modal :active="activeDeleteModal" @close="activeDeleteModal=!activeDeleteModal">
      <template slot="modal-content">
        <div class="delete-modal-top">
          <div class="circle has-background-danger">
            <span class="icon is-large has-text-white">
              <i class="fas fa-3x fa-trash-alt"></i>
            </span>
          </div>
        </div>
        <p class="is-size-5-tablet is-size-6-mobile has-text-centered">
          ¿Deseas borrar el
          <strong>material {{element.nombre}}</strong>
          de nuestros registros?
        </p>
        <div class="columns is-mobile is-multiline is-centered m-0">
          <div class="column is-6 has-text-centered">
            <span
              class="button is-rounded is-danger left-button"
              @click="activeDeleteModal=!activeDeleteModal"
            >No</span>
          </div>
          <div class="column is-6 has-text-centered">
            <span class="button is-rounded is-success right-button" @click="deleteElement">Si</span>
          </div>
        </div>
      </template>
    </base-modal>

    <!-- editar -->
    <base-modal :active="activeEditModal" @close="activeEditModal=!activeEditModal">
      <template slot="modal-content">
        <form class='columns is-multiline is-mobile m-0 p-t-sm p-l-md p-r-md p-b-md'
          @submit.prevent="submitEdit"
        >
          <p class='column is-12 has-text-weight-bold has-text-centered is-size-5 m-none'>Editar material</p>

          <div class="field column is-12 p-b-0 m-b-0">
            <label class="label is-size-7-mobile">Nombre</label>
            <div class="control">
              <input
                class="input"
                type="text"
                placeholder="Nombre del elemento"
                v-model="$v.element.nombre.$model"
              >
            </div>
            <p class="help is-danger" v-if='$v.element.nombre.$error'>Este campo es requerido</p>
          </div>

          <div class="field column is-6-tablet is-12-mobile p-b-0 m-b-0">
            <label class="label is-size-7-mobile">No. Serie</label>
            <div class="control">
              <input
                class="input"
                type="text"
                placeholder="Número de serie"
                v-model="$v.element.no_serie.$model"
              >
            </div>
            <p class="help is-danger" v-if="$v.element.no_serie.$error">Este campo es requerido</p>
          </div>

          <div class="field column is-6-tablet is-12-mobile p-b-0 m-b-0">
            <label class="label is-size-7-mobile">No. Piezas</label>
            <div class="control">
              <input
                class="input"
                type="text"
                placeholder="Número de serie"
                v-model="$v.element.no_piezas.$model"
              >
            </div>
            <p
              class="help is-danger"
              v-if="$v.element.no_piezas.$error"
            >Este campo debe ser un número entero</p>
          </div>

          <div class="field column is-12 p-b-0 m-b-0">
            <label class="label is-size-7-mobile">Descripción</label>
            <div class="control">
              <textarea
                class="textarea"
                placeholder="Descripción del elemento"
                :rows="2"
                v-model="$v.element.descripcion.$model"
                @input="$v.element.descripcion.$touch()"
              ></textarea>
            </div>
            <p
              class="help is-danger"
              v-if="$v.element.descripcion.$error"
            >El número de caracteres máximos es de 150, este campo debe llenarse</p>
            <p class="help has-text-right has-text-primary">150</p>
          </div>

          <button class="button is-rounded is-fullwidth is-primary">Actualizar</button>
        </form>
      </template>
    </base-modal>
  </div>
</template>

<script>
import TopBar from "../components/TopBar.vue";
import ElementCard from "../components/ElementCard.vue";
import BaseModal from "../components/BaseModal.vue";
import { validationMixin } from "vuelidate";
import { required, integer, maxLength } from "vuelidate/lib/validators";
import axios from "axios";

export default {
  name: "home",
  mixins: [validationMixin],
  components: {
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
      no_serie: null,
      no_piezas: null,
      eliminado: false
    }
  }),
  created() {
    this.getElements();
  },
  methods: {
    getElements() {
      axios
        .get(`/api/Elements/materiales`)
        .then(response => {
          this.elements = response.data.data;
        })
        .catch(e => {
          console.log(e.response);
        });
    },
    submit() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        axios
          .post("/api/Elements/materiales", {
            nombre: this.$v.element.nombre.$model,
            descripcion: this.$v.element.descripcion.$model,
            no_serie: this.$v.element.no_serie.$model,
            no_piezas: this.$v.element.no_piezas.$model
          })
          .then(response => {
            this.active = false;
          })
          .catch(e => {
            console.log(e.response);
          });
        this.getElements();
      } else {
        console.log("Error en el formulario");
      }
    },
    deleteElement() {
      axios
        .delete(
          `/api/Elements/materiales/${this.element.id}`
        )
        .then(response => {
          this.activeDeleteModal = false;
          this.getElements();
        })
        .catch(e => {
          console.log(e);
        });
      this.initializeElement;
    },
    submitEdit() {
      this.$v.$touch();
      if (!this.$v.$invalid) {
        axios
          .put(
            `/api/Elements/materiales/${this.element.id}`,
            {
              nombre: this.$v.element.nombre.$model,
              descripcion: this.$v.element.descripcion.$model,
              no_serie: this.$v.element.no_serie.$model,
              no_piezas: this.$v.element.no_piezas.$model
            }
          )
          .then(response => {
            this.getElements();
            this.activeEditModal = false;
          })
          .catch(e => {
            console.log(e.response);
          });
      } else {
        console.log("Error en editar");
      }
    },
    openCreateModal() {
      this.initializeElement();
      this.active = !this.active;
    },
    setDeleteModal(x) {
      this.initializeElement();
      axios
        .get(`/api/Elements/materiales/${x}`)
        .then(response => {
          this.element = response.data.data;
          this.activeDeleteModal = true;
        })
        .catch(e => {
          console.log(e);
        });
    },
    setEditModal(x) {
      this.initializeElement();
      axios
        .get(`/api/Elements/materiales/${x}`)
        .then(response => {
          this.element.id = response.data.data.id;
          this.element.nombre = response.data.data.nombre;
          this.element.descripcion = response.data.data.descripcion;
          this.element.no_serie = response.data.data.no_serie;
          this.element.no_piezas = response.data.data.no_piezas;
          this.activeEditModal = true;
        })
        .catch(e => {
          console.log(e);
        });
    },
    initializeElement() {
      this.element.id = null;
      this.element.nombre = null;
      this.element.descripcion = null;
      this.element.no_serie = null;
      this.element.no_piezas = null;
      this.element.eliminado = null;
    },
    search(name) {
      axios
        .post("/api/Elements/search/material", {
          search: name
        })
        .then(response => {
          this.elements = response.data;
        })
        .catch(e => {
          console.log(e.response);
        });
    }
  }
};
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
