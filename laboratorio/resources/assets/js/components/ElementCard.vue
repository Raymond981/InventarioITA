<template>
  <div :class="['element-card', {'element-card--maintenance' : element.mantenimiento}]">
    <div class='columns is-multiline is-mobile'>
      <div class='column is-10'>
        <p :class="['p-none has-text-weight-bold is-size-5-tablet is-size-6-mobile', {'has-text-white': element.mantenimiento}]">
          {{element.nombre}}
        </p>
      </div>
      <div class="column is-2">
        <div :class="['dropdown is-hoverable is-right is-pulled-right', {'has-text-white':element.mantenimiento}]">
          <div class="dropdown-trigger">
            <span class="icon is-small" aria-haspopup="true">
              <i class="fas fa-ellipsis-v"></i>
            </span>
          </div>
          <div class="dropdown-menu" role="menu">
            <div class="dropdown-content">
              <a class="dropdown-item is-size-7-mobile" @click='openDeleteModal'>Eliminar</a>
              <a class="dropdown-item is-size-7-mobile" @click='openEditModal'>Editar</a>
            </div>
          </div>
        </div>
      </div>
      <div class="column is-9-tablet is-12-mobile p-t-0">
        <p :class="['has-text-justified is-size-6-tablet is-size-7-mobile', {'has-text-white':element.mantenimiento}]">
          {{element.descripcion}}
        </p>
      </div>
      <div class="column is-3-tablet is-12-mobile centered p-t-0">
        <p :class="[{'has-text-white': element.mantenimiento}]">{{element.no_piezas}} elementos</p>
      </div>
    </div>
  </div>
</template>

<script>

  export default {
    name: 'ElementCard',
    props: {
      element: {
        type: Object,
        required: true
      }
    },
    methods: {
      openDeleteModal () {
        this.$emit('openDeleteModal', this.element.id)
      },
      openEditModal () {
        this.$emit('openEditModal', this.element.id)
      }
    }
  }
</script>

<style lang="sass" scoped>
  .element-card
    border-radius: .2rem
    -webkit-box-shadow: 0px 0px 6px 0px rgba(49,62,80,0.2)
    -moz-box-shadow: 0px 0px 6px 0px rgba(49,62,80,0.2)
    box-shadow: 0px 0px 6px 0px rgba(49,62,80,0.2)

  .element-card--maintenance
    background: #ffb96a

  .dropdown-menu
    min-width: 6em

  .centered
    display: flex
    justify-content: center
    align-items: center

  .p-b-0
    padding-bottom: 0 !important

  .p-t-0
    padding-top: 0 !important

  .p-r-0
    padding-right: 0 !important
</style>
