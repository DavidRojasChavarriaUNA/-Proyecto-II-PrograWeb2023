<template>
    <h2 class="text-center">Listado de votaciones</h2>
    <div class="row">
        <div class="col-12 text-end">
            <a href="/votacion/create" class="btn btn-primary"><i class="bi bi-plus"></i>Nuevo</a>
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
                        <router-link :to="`/votacion/${idUsuario}/${votacion.id}/edit`" class="text-primary accion" title="Modificar"><i
                                class="bi bi-pencil"></i></router-link>
                        <router-link :to="`/resultados/${idUsuario}/${votacion.id}`" class="text-success accion" title="Ver resultados"><i
                                class="bi bi-eye-fill"></i></router-link>

                                <!--CAMBIAR-->
                        <a id="btnDesactivar{{idEstado}}" class="text-danger accion" title="Desactivar"
                            data-bs-toggle="modal" data-bs-target="#modalDesactivar{{id}}"><i class="bi bi-x-lg"></i></a>
                        <a id="btn{{idEstado}}" class="text-danger accion" title="Eliminar" data-bs-toggle="modal"
                            data-bs-target="#modalEliminar{{id}}"><i class="bi bi-trash"></i></a>
                        
                        <!-- <section id="modales{{id}}">
                            {{> /modales/modalEliminarVotacion }}
                            {{> /modales/modalDesactivar }}
                        </section> -->

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { Codigos } from '../../js/sitioInterno'

const urlBase = import.meta.env.VITE_BASE_URL;

export default {
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
                    this.votaciones = datosVotaciones.votaciones;
                } else {
                    this.$emit('mostrarMensaje', datosVotaciones);
                }
            } catch (error) {
                console.log(error);
                this.$emit('mostrarMensaje', { Code: Codigos.CodeError, message: "Ocurrió un error al obtener las votaciones" });
            }
        }
    }
}
</script>