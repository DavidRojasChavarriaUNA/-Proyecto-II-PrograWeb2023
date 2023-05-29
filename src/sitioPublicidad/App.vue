<template>
  <header-publicidad></header-publicidad>
  <router-view></router-view>
  <footer-publicidad></footer-publicidad>
</template>

<script>
import { Codigos } from '../js/sitioPublicidad'
import headerPublicidad from './headerPublicidad.vue'
import footerPublicidad from './footerPublicidad.vue'
import toastAlert from '../toadsAlerts/toastAlert.vue'

const urlBase = 'http://localhost:8089/server'

export default {
  data() {
    return {
    }
  },
  components: {
    headerPublicidad,
    footerPublicidad,
    toastAlert
  },
  methods: {
  }
}
</script>