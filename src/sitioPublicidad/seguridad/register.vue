<template>
  <main class="uk-container">
    <article id="registro" class="uk-section uk-section-muted uk-flex uk-flex-middle uk-animation-fade"
      uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
          <div class="uk-width-1-1@m">
            <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
              <h3 class="uk-card-title uk-text-center">Bienvenido a bordo!</h3>
              <form>
                <div class="uk-margin">
                  <label class="uk-form-label" for="form-stacked-text">Nombre</label>
                  <div class="uk-inline uk-width-1-1">
                    <span for="name" class="uk-form-icon" uk-icon="icon: info"></span>
                    <input class="uk-input uk-form-large" type="text" name="name" maxlength=30 v-model="user.name"
                      required />
                  </div>
                </div>
                <div class="uk-margin">
                  <label class="uk-form-label" for="form-stacked-text">Correo Electrónico</label>
                  <div class="uk-inline uk-width-1-1">
                    <span for="email" class="uk-form-icon" uk-icon="icon: mail"></span>
                    <input class="uk-input uk-form-large" type="email" name="email" maxlength=100 v-model="user.email"
                      required />
                  </div>
                </div>
                <div class="uk-margin">
                  <label class="uk-form-label" for="form-stacked-text">Usuario</label>
                  <div class="uk-inline uk-width-1-1">
                    <span for="user" class="uk-form-icon" uk-icon="icon: user"></span>
                    <input class="uk-input uk-form-large" type="text" name="user" maxlength=20 v-model="user.user"
                      required />
                  </div>
                </div>
                <div class="uk-margin">
                  <label class="uk-form-label" for="form-stacked-text">Contraseña</label>
                  <div class="uk-inline uk-width-1-1">
                    <span for="password" class="uk-form-icon" uk-icon="icon: lock"></span>
                    <input class="uk-input uk-form-large" type="password" name="password" maxlength=20
                      v-model="user.password" required />
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-button-large uk-width-1-1" v-on:click="createUser(user)">
                    Registrar
                  </button>
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
      user: { 'name': '', 'email': '', 'user': '', 'password': '' }
    }
  },
  components: {

  },
  methods: {
    async createUser(u) { 
      console.log(u);
      try {
        const respuestaHttp = await fetch(`${urlBase}/seguridad/register`,
          {
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            method: 'POST',
            body: JSON.stringify(u)
          });
          console.log(respuestaHttp);
        const respuesta = await respuestaHttp.json();
        if (respuesta && (respuesta.Code == Codigos.CodeSuccess)) {
          //enviar al login
          router.push('/login');
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