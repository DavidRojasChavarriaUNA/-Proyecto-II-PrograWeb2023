<template>
  <header-publicidad></header-publicidad>
  <router-view></router-view>
  <footer-publicidad></footer-publicidad>
</template>

<script>
import headerPublicidad from './headerPublicidad.vue'
import footerPublicidad from './footerPublicidad.vue'

const urlBase = import.meta.env.VITE_BASE_URL;

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