<template>
    <main class="uk-container">
    <article id="registro" class="uk-section uk-section-muted uk-flex uk-flex-middle uk-animation-fade"
        uk-height-viewport="expand: true">
        <div class="uk-container">
            <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                <div class="uk-width-1-1@m">
                    <div
                        class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                        <h3 class="uk-card-title uk-text-center">
                            Bienvenido de vuelta!
                        </h3>
                        <form class="uk-form-stacked">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="form-stacked-text">Correo electrónico</label>
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                    <input class="uk-input uk-form-large" type="email" name="email" v-model="user.email"
                                        required />
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="form-stacked-text">Contraseña</label>
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                    <input class="uk-input uk-form-large" type="password" name="password"
                                    v-model="user.password" required />
                                </div>
                            </div>
                            <div class="uk-margin">
                                <button class="uk-button uk-button-primary uk-button-large uk-width-1-1" v-on:click="loginUser(user)">
                                    Iniciar Sesión
                                </button>
                            </div>
                            <div class="uk-text-small uk-text-center">
                                Necesita registrarse?
                                <a href="/seguridad/showRegistrationForm">Crear una cuenta</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>
</main>
</template>

<script>
import { Codigos } from '../../js/sitioPublicidad'

const urlBase = import.meta.env.VITE_BASE_URL;

export default {
  data() {
    return {
      user: { 'email': '', 'password': '' }
    }
  },
  components: {

  },
  methods: {
    async loginUser(u) { 
      console.log(u);
      try {
      
        const respuestaHttp = await fetch(`${urlBase}/seguridad/autenticate`,
          {
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            method: 'POST',
            body: JSON.stringify(u)
          });
          console.log('RERS'+respuestaHttp);
        const respuesta = await respuestaHttp.json();
        console.log('RESPUESTA '+respuesta);
        if (respuesta && (respuesta.Code == Codigos.CodeSuccess)) {
          //this.$emit('mostrarMensaje', respuesta);
          //enviar al sitio interno
          router.push(`/sitioInterno/${respuesta.id}`);
        } else {
          this.$emit('mostrarMensaje', respuesta);
        }
      } catch (error) {
        console.log(error);
        this.$emit('mostrarMensaje', { Code: Codigos.CodeError, message: "Ocurrió un error al registrar el usuario" });
      }
    }
  }
}
</script>