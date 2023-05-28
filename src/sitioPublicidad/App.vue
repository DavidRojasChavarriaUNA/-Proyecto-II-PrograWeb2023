<template>
  <header-publicidad></header-publicidad>
  <!-- <main id="principal" class="container">
      <section id="toastMensajes">
        <toast-alert v-model="respuestaServicio" v-bind:respuestaServicio="respuestaServicio"></toast-alert>
      </section>
    <router-view v-on:mostrarMensaje="mostrarMensaje"></router-view>
  </main> -->
  <footer-publicidad></footer-publicidad>
</template>

<script>
  import {Codigos} from '../js/sitioPublicidad'
  import headerPublicidad from './headerPublicidad.vue'
  import footerPublicidad from './footerPublicidad.vue'
  import toastAlert from '../toadsAlerts/toastAlert.vue'

  const urlBase = 'http://localhost:8089/server'

  export default {
    data() {
      return {
        message: 'Hello World!'
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