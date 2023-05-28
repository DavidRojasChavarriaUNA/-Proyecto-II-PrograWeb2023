<template>
    <h2 class="text-center">Listado de votaciones pendientes</h2>
    <div class="row">
        <div class="col-12 text-end" style="height: 38px;">
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
                    <td>{{votacion.descripcion}}</td>
                    <td>{{votacion.estado}}</td>
                    <td>{{votacion.fechaHoraInicio}}</td>
                    <td>{{votacion.fechaHoraFin}}</td>
                    <td>
                        <!-- <a href="/votante/{{id}}/votar" class="text-primary accion" title="Votar"><i
                                class="bi bi-x-square-fill"></i></a>
                        <a href="/resultados/{{id}}" class="text-success accion" title="Ver resultados"><i
                                class="bi bi-eye-fill"></i></a> -->
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {Codigos} from '../../js/sitioInterno'

    const urlBase = 'http://localhost:8089/server';

    export default {
        data() {
            return {
                idUsuario: 0,
                votacionesPendientes: []
            }
        },
        created() {
            this.InicializarData();
            this.obtenerVotacionesPendientes();
        },
        methods: {
            InicializarData() {
                this.idUsuario = this.$route.params.idUsuario;
            },
            async obtenerVotacionesPendientes() {
                try {
                    const respuestaHttp = await fetch(`${urlBase}/votante/${this.idUsuario}`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const datosVotacionesUsuario = await respuestaHttp.json();
                    if (datosVotacionesUsuario && (datosVotacionesUsuario.Code == Codigos.CodeSuccess)) {
                        this.votacionesPendientes = datosVotacionesUsuario.votaciones;
                    } else {
                        alert(datosVotacionesUsuario.message);
                    }
                } catch (error) {
                    console.log(error);
                    alert("Ocurrió un error al obtener el usuario");
                    this.$router.push('/');
                }
            }
        }
    }
</script>