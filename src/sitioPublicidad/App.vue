<template>
  <header-publicidad></header-publicidad>
  <router-view></router-view>
  <footer-publicidad></footer-publicidad>
</template>

<script>
import headerPublicidad from './headerPublicidad.vue'
import footerPublicidad from './footerPublicidad.vue'

const urlBase = 'http://localhost:8089/server'

export default {
  data() {
    return {
    }
  },
  components: {
    headerPublicidad,
    footerPublicidad
  },
  methods: {
  }
}
</script>