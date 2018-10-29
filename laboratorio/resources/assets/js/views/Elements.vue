<template>
  <div>
    Elements {{tipo}}
  </div>
</template>

<script>
  export default {
    name: 'home',
    props: {
      tipo: {
        type: String,
        required: true,
        default: ''
      }
    },
    computed: {
      welcome() {
        return 'Toto'
      }
    }
  }
</script>
