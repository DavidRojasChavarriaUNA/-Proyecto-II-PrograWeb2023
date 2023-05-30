<template>
    <article id="Votar" class="p-4 border bg-light">
        <h1 class="text-center mb-4">Realice su votación</h1>
        <section class="m-3 p-3">
            <h2 class="text-center">{{votacionSeleccionada.descripcion}}</h2>
        </section>
        <div class="container">
            <div class="row bg-white">
                <option-vote v-for="opcion in votacionSeleccionada.opciones" 
                    v-bind:key="opcion.id" v-bind:opcion="opcion" v-on:seleccionarOpcion="seleccionarOpcion">
                </option-vote>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mt-5">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                    data-bs-target="#modalConfirmarVotacion">
                    Confirmar Votación
                </button>
            </div>
        </div>
        <!-- {{#opcionSeleccionada}}
        {{#opcionConfirmar}}
        {{> /modales/modalConfirmarVotacion}}
        {{/opcionConfirmar}}
        {{/opcionSeleccionada}}
        {{^opcionSeleccionada}}
        {{> /modales/modalDebeSeleccionarUnaOpcion}}
        {{~opcionSeleccionada}} -->
    </article>
</template>

<script>
    import {Codigos} from '../../js/sitioInterno';
    import optionVote from './option.vue';

    const urlBase = import.meta.env.VITE_BASE_URL;

    export default {
        data() {
            return {
                idUsuario: 0,
                votacionSeleccionada: {
                    id: 0
                },
                opcionSeleccionada: null
            }
        },
        components:{
            optionVote
        },
        created() {
            this.InicializarData();
            this.obtenerVotacionSeleccionada();
        },
        methods: {
            InicializarData() {
                this.idUsuario = this.$route.params.idUsuario;
                this.votacionSeleccionada.id = this.$route.params.idVotacion;
            },
            async obtenerVotacionSeleccionada() {
                try {
                    const url = `${urlBase}/votante/${this.votacionSeleccionada.id}/votar`;
                    const respuestaHttp = await fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const datosVotacionSeleccionada = await respuestaHttp.json();
                    if (datosVotacionSeleccionada && (datosVotacionSeleccionada.Code == Codigos.CodeSuccess)) {
                        this.votacionSeleccionada = datosVotacionSeleccionada.votacion;
                    } else {
                        this.$emit('mostrarMensaje', datosVotacionSeleccionada);
                    }
                } catch (error) {
                    console.log(error);
                    this.$emit('mostrarMensaje', {
                        Code: Codigos.CodeError,
                        message: "Ocurrió un error al obtener la votación seleccionada"
                    });
                    this.$router.push(`/votante/${this.idUsuario}`);
                }
            },
            seleccionarOpcion(idOpcion){
                this.opcionSeleccionada = idOpcion;
            }
        }
    }
</script>