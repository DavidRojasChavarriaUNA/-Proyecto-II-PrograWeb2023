<template>
  <header-sitio-interno v-bind:usuario="usuario"></header-sitio-interno>
  <main id="principal" class="container">
      <section id="toastMensajes">
        <toast-alert v-model="respuestaServicio" v-bind:respuestaServicio="respuestaServicio"></toast-alert>
      </section>
    <router-view v-on:mostrarMensaje="mostrarMensaje"></router-view>
  </main>
  <footer-sitio-interno></footer-sitio-interno>
</template>

<script>
  import {Codigos} from '../js/sitioInterno'
  import headerSitioInterno from './headerSitioInterno.vue'
  import footerSitioInterno from './footerSitioInterno.vue'
  import toastAlert from '../toadsAlerts/toastAlert.vue'

  const urlBase = import.meta.env.VITE_BASE_URL;

  export default {
    data() {
      return {
        usuario: {
          id: "0",
          name: ""
        },
        respuestaServicio: {
          mostrarMensaje: false,
          Code: Codigos.None,
          message: ''
        }
      }
    },
    components: {
      headerSitioInterno,
      footerSitioInterno,
      toastAlert
    },
    created() {
      this.obtenerUsuarioAutenticado();
    },
    updated() {
      this.setCssClasses();
    },
    methods: {
      setCssClasses() {
        const body = document.querySelector("body");
        const footer = document.querySelector("footer");
        //se quitan todos los footer para limpiar si se duplican
        document.querySelectorAll("footer").forEach(f => f.remove());
        //se determina si es el sitio interno la pantalla de ingreso, para acomodar el footer en su posición
        if (this.$route.fullPath.toLowerCase().includes('/sitiointerno')) {
          body.classList.add('d-flex', 'flex-column', 'min-vh-100');
          footer.classList.add('mt-auto');
          body.appendChild(footer);
        }
        else{
          body.classList.remove('d-flex', 'flex-column', 'min-vh-100');
          footer.classList.remove('mt-auto');
          document.querySelector("#app").appendChild(footer);
        }
      },
      async obtenerUsuarioAutenticado() {
        try {
          const idUsuario = this.$route.params.idUsuario;
          const respuestaHttp = await fetch(`${urlBase}/seguridad/${idUsuario}`, {
            headers: {
              'Accept': 'application/json'
            }
          });
          const datosUsuario = await respuestaHttp.json();
          if (datosUsuario && (datosUsuario.Code == Codigos.CodeSuccess)) {
            this.usuario = datosUsuario.User;
          } else {
            alert(datosUsuario.message);
            this.$router.push('/');
          }
        } catch (error) {
          console.log(error);
          alert("Ocurrió un error al obtener el usuario");
          this.$router.push('/');
        }
      },
      mostrarMensaje(respuestaServidor){
        respuestaServidor.mostrarMensaje = true;
        this.respuestaServicio = respuestaServidor;
      }
    }
  }
</script>