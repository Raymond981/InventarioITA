<template>
  <div class='columns is-mobile is-multiline p-t-sm p-r-sm p-l-sm'>
    <div class='column is-12'>
      <top-bar @open="active=!active" element="tipo"></top-bar>
      <base-modal :active="active" @close="active=!active">
        <template slot="modal-content">
          <p>Totdfvoijdoivjdiouf</p>
        </template>
      </base-modal>
    </div>
    <div class='column is-12'>
      <p class='is-size-2 has-text-centered has-text-weight-semibold has-text-success'>Dashboard</p>
    </div>
  </div>
</template>

<script>
import TopBar from '../components/TopBar.vue'
import BaseModal from '../components/BaseModal.vue'

  export default {
    name: 'home',
    components:{
      TopBar,
      BaseModal
    },
    data () {
      return {
        active: false
      }
    }
  }
</script>
