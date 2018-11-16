<template>
  <div class='columns is-mobile is-multiline'>
    <div :class='["column is-hidden-tablet p-b-none",{"is-12 has-text-centered":element==="todos"}, {"is-4":element!=="todos"}]'>
      <p class='has-text-weight-semibold has-text-primary is-size-5-tablet has-text-centered is-capitalized'>{{element}}</p>
    </div>
    <div class='column is-7 is-hidden-tablet p-b-none' v-if='element!=="todos"'>
      <a class="button is-rounded is-primary" @click="open">
        <span class="icon">
          <i class="fas fa-plus"></i>
        </span>
        <span>Nuevo registro</span>
      </a>
    </div>

    <div :class='["column is-hidden-mobile",{"is-3 has-text-centered":element==="todos"},{"is-3-tablet":element!=="todos"}]'>
      <p class='has-text-weight-semibold has-text-primary is-size-5-tablet has-text-centered is-capitalized'>{{element}}</p>
    </div>
    <div :class='["column is-12-mobile" ,{"is-7-tablet is-centered":element==="todos"},{"is-6-tablet":element!=="todos"}]'>
      <div class='field has-addons'>
        <div class='control is-expanded'>
          <input class='input is-rounded' type='text' :placeholder="'Buscar ' + element" v-model='elementSearched'>
        </div>
        <div class='control'>
          <a class='button is-info is-rounded' @click='search'>
            <span class='icon'>
              <i class='fas fa-search'></i>
            </span>
          </a>
        </div>
      </div>
    </div>
    <div class='column is-3-tablet is-hidden-mobile' v-if='element!=="todos"'>
      <a class="button is-rounded is-primary" @click="open">
        <span class="icon">
          <i class="fas fa-plus"></i>
        </span>
        <span>Nuevo registro</span>
      </a>
    </div>
  </div>
</template>

<script>

  export default {
    name: 'home',
    computed: {
      welcome() {
        return 'Toto'
      }
    },
    props: {
      element: {
        type: String,
        required: true
      }
    },
    data: () => ({
      elementSearched: ''
    }),
    methods: {
      open () {
        this.$emit('open')
      },
      search () {
        this.$emit('search',this.elementSearched)
      }
    }
  }
</script>

<style lang="sass" scoped>
  .p-b-none
    padding-bottom: 0 !important
</style>
