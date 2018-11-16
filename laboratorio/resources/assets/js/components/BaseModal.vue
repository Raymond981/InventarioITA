<template>
  <div :class="['modal', {'is-active':active}]">
    <div class="modal-background" @click="close"></div>
    <div class="modal-content">
      <slot name="modal-content"></slot>
    </div>
    <button class="modal-close is-large" aria-label="close" @click="close"></button>
  </div>
</template>

<script>
export default {
  name: 'BaseModal',
  props: {
    active: {
      type: Boolean,
      required: true
    }
  },
  data () {
    return {
    }
  },
  methods: {
    close () {
      this.$emit('close')
    }
  }
}
</script>

<style scoped lang="sass">
  .modal-content
    background-color: white
    border-radius: .3rem
    max-height: none

</style>
