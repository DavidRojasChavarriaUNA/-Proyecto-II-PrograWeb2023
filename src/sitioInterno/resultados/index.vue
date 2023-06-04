<template>
    <h2 class="text-center">Listado de votaciones activas y finalizadas</h2>
    <div class="row">
        <div class="col-12 text-end" style="height: 38px;">
        </div>
    </div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn btn-primary" v-on:click="obtenerVotacionesActivasFinalizadas">Consultar</button>
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
                <tr v-for="votacion in votacionesActivasFinalizadas" :key="votacion.id">
                    <td>{{votacion.descripcion}}</td>
                    <td>{{votacion.estado}}</td>
                    <td>{{votacion.fechaHoraInicio}}</td>
                    <td>{{votacion.fechaHoraFin}}</td>
                    <td>
                        <router-link :to="`/resultados/${idUsuario}/${votacion.id}`" class="text-success accion" title="Ver resultados"><i
                                class="bi bi-eye-fill"></i></router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {Codigos} from '../../js/sitioInterno'

    const urlBase = import.meta.env.VITE_BASE_URL;

    export default {
        data() {
            return {
                idUsuario: 0,
                votacionesActivasFinalizadas: []
            }
        },
        created() {
            this.InicializarData();
            this.obtenerVotacionesActivasFinalizadas();
        },
        methods: {
            InicializarData() {
                this.idUsuario = this.$route.params.idUsuario;
            },
            async obtenerVotacionesActivasFinalizadas() {
                try {
                    const respuestaHttp = await fetch(`${urlBase}/resultados`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const datosVotaciones = await respuestaHttp.json();
                    if (datosVotaciones && (datosVotaciones.Code == Codigos.CodeSuccess)) {
                        this.votacionesActivasFinalizadas = datosVotaciones.votaciones;
                        this.$emit('mostrarMensaje',{Code: Codigos.CodeSuccess, message: "Se ha obtenido los datos más recientes"});
                    } else {
                        this.$emit('mostrarMensaje',datosVotaciones);
                    }
                } catch (error) {
                    console.log(error);
                    this.$emit('mostrarMensaje',{Code: Codigos.CodeError, message: "Ocurrió un error al obtener las votaciones pendientes del usuario"});
                }
            }
        }
    }
</script>