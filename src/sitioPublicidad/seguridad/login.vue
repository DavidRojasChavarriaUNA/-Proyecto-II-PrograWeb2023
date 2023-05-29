<template>
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
                        <form action="/seguridad/autenticate" method="post" class="uk-form-stacked">
                            <div class="uk-margin">
                                <label class="uk-form-label" for="form-stacked-text">Correo electrónico</label>
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                    <input class="uk-input uk-form-large" type="email" name="email" value="{{email}}"
                                        required />
                                </div>
                            </div>
                            <div class="uk-margin">
                                <label class="uk-form-label" for="form-stacked-text">Contraseña</label>
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                    <input class="uk-input uk-form-large" type="password" name="password"
                                        value="{{password}}" required />
                                </div>
                            </div>

                            <div class="uk-margin">
                                <button class="uk-button uk-button-primary uk-button-large uk-width-1-1">
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
</template>

<script>
import { Codigos } from '../../js/sitioPublicidad'

const urlBase = 'http://localhost:8089/server';

export default {
    data() {
        return {
        }
    },
    components: {

    },
    methods: {
    }
}
</script>