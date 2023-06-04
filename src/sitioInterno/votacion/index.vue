<template>
    <section class="m-5">
        <h2 class="text-center">Listado de votaciones</h2>
        <div class="row">
            <div class="col-12 text-end">
                <button class="btn btn-primary" v-on:click="obtenerVotaciones" style="margin-right: 10px;">Consultar</button>
                <router-link :to="`/votacion/create/${idUsuario}`" class="btn btn-primary" title="Nuevo"><i
                        class="bi bi-plus"></i>Nuevo</router-link>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Apertura</th>
                        <th>Cierre</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="votacion in votaciones" :key="votacion.id">
                        <td>{{ votacion.descripcion }}</td>
                        <td>{{ votacion.estado }}</td>
                        <td>{{ votacion.fechaHoraInicio }}</td>
                        <td>{{ votacion.fechaHoraFin }}</td>
                        <td>
                            <router-link  :id="`btn${votacion.idEstado}`" :to="`/votacion/${idUsuario}/${votacion.id}/edit`" class="text-primary accion"
                                title="Modificar"><i class="bi bi-pencil"></i></router-link>
                            <router-link :id="`btnResultados${votacion.idEstado}`" :to="`/resultados/${idUsuario}/${votacion.id}`" class="text-success accion"
                                title="Ver resultados"><i class="bi bi-eye-fill"></i></router-link>

                            <a :id="`btn${votacion.idEstado}`" class="text-danger accion" title="Eliminar"
                                data-bs-toggle="modal" :data-bs-target="`#modalEliminar${votacion.id}`"><i
                                    class="bi bi-trash"></i></a>
                            <a :id="`btnDesactivar${votacion.idEstado}`" class="text-danger accion" title="Desactivar"
                                data-bs-toggle="modal" :data-bs-target="`#modalDesactivar${votacion.id}`"><i
                                    class="bi bi-x-lg"></i></a>
                            <modal-eliminar-vue v-bind:id="votacion.id"
                                v-on:notificarEliminar="notificarEliminar(votacion.id)"></modal-eliminar-vue>
                            <modal-desactivar-vue v-bind:id="votacion.id"
                                v-on:notificarDesactivar="notificarDesactivar(votacion.id)"></modal-desactivar-vue>


                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>

<script>
import { Codigos } from '../../js/sitioInterno'

import modalEliminarVue from './modalEliminarVotacion.vue';
import modalDesactivarVue from './modalDesactivar.vue';

import * as bootstrap from 'bootstrap';

const urlBase = import.meta.env.VITE_BASE_URL;

export default {
    components: {
        modalEliminarVue,
        modalDesactivarVue
    },
    data() {
        return {
            idUsuario: 0,
            votaciones: []
        }
    },
    created() {
        this.InicializarData();
        this.obtenerVotaciones();
    },
    methods: {
        InicializarData() {
            this.idUsuario = this.$route.params.idUsuario;
        },
        async obtenerVotaciones() {
            try {
                const respuestaHttp = await fetch(`${urlBase}/votacion`, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                console.log(respuestaHttp);
                const datosVotaciones = await respuestaHttp.json();
                console.log(datosVotaciones);
                if (datosVotaciones && (datosVotaciones.Code == Codigos.CodeSuccess)) {
                    this.votaciones = datosVotaciones.votacion;
                    this.$emit('mostrarMensaje',{Code: Codigos.CodeSuccess, message: "Se ha obtenido los datos más recientes"});
                } else {
                    this.$emit('mostrarMensaje', datosVotaciones);
                }
            } catch (error) {
                console.log(error);
                this.$emit('mostrarMensaje', { Code: Codigos.CodeError, message: "Ocurrió un error al obtener las votaciones" });
            }
        },
        cerrarModalEliminar(id) {
            const modalEliminarElem = document.querySelector(`#modalEliminar${id}`);
            const modalEliminar = bootstrap.Modal.getInstance(modalEliminarElem);
            modalEliminar.hide();
        },
        async notificarEliminar(votacionID) {
            this.cerrarModalEliminar(votacionID);
            try {
                const respuestaHttp = await fetch(`${urlBase}/votacion/${votacionID}/delete`,
                    {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                const datosVotaciones = await respuestaHttp.json();
                this.$emit('mostrarMensaje', datosVotaciones);
                this.obtenerVotaciones();
            } catch (error) {
                console.log(error);
                this.$emit('mostrarMensaje', { Code: Codigos.CodeError, message: "Ocurrió un error al eliminar la votación" });
            }
        },
        cerrarModalDesactivar(id) {
            const modalDesactivarElem = document.querySelector(`#modalDesactivar${id}`);
            const modalDesactivar = bootstrap.Modal.getInstance(modalDesactivarElem);
            modalDesactivar.hide();
        },
        async notificarDesactivar(votacionID) {
            this.cerrarModalDesactivar(votacionID);

            try {
                const respuestaHttp = await fetch(`${urlBase}/votacion/${votacionID}/desactivar`,
                    {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                const res = await respuestaHttp.json();
                this.$emit('mostrarMensaje', res);
                this.obtenerVotaciones();
            } catch (error) {
                console.log(error);
                this.$emit('mostrarMensaje', { Code: Codigos.CodeError, message: "Ocurrió un error al eliminar la votación" });
            }
        }


    }
}
</script>