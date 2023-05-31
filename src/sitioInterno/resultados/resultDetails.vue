<template>
    <form>
        <h1 class="text-center">Listado de resultados</h1>
        <div class="row mb-3">
            <div class="col-12">
                <label class="form-label fs-3 mt-2">Titulo votación:</label>
                <input type="text" class="form-control" :value="votacion.descripcion" readonly>
            </div>
            <div class="col-6">
                <label class="form-label fs-3 mt-2">Fecha y hora de apertura:</label>
                <input type="datetime-local" class="form-control" :value="votacion.fechaHoraInicio" readonly>
            </div>
            <div class="col-6">
                <label class="form-label fs-3 mt-2">Fecha y hora de cierre</label>
                <input type="datetime-local" class="form-control" :value="votacion.fechaHoraFin" readonly>
            </div>
        </div>

        <h3 class="text-secondary mt-5 mb-3">Resultados detallados:</h3>
        <div class="container">
            <div class="row bg-white" id="ListaOpcionesModificar">
                <div class="cards mt-3 mb-5">
                    <div class="row row-cols-3 g-4">
                        <div class="col" v-for="resultado in votacion.resultados" :key="resultado.opcion">
                            <div class="card" style="width: 18rem;">
                                <img :src="resultado.rutaImagen" class="card-img-top">
                                <div class="card-body">
                                    <div class="col">
                                        <h5 class="card-title" style="text-align: center;"> {{resultado.opcion}}</h5>
                                    </div>
                                    <div class="col">
                                        <p class="card-text">Cantidad de votos obtenidos: {{resultado.cantidad}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import {Codigos} from '../../js/sitioInterno';

    const urlBase = import.meta.env.VITE_BASE_URL;

    export default {
        data() {
            return {
                idUsuario: 0,
                votacion: {
                    id: 0
                },
            }
        },
        created() {
            this.InicializarData();
            this.obtenerResultadoVotacion();
        },
        methods: {
            InicializarData() {
                this.idUsuario = this.$route.params.idUsuario;
                this.votacion.id = this.$route.params.idVotacion;
            },
            async obtenerResultadoVotacion() {
                try {
                    const respuestaHttp = await fetch(`${urlBase}/resultados/${this.votacion.id}`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    const resultadosVotacion = await respuestaHttp.json();
                    if (resultadosVotacion && (resultadosVotacion.Code == Codigos.CodeSuccess)) {
                        this.votacion = resultadosVotacion.votacion;
                    } else {
                        this.$emit('mostrarMensaje', resultadosVotacion);
                    }
                } catch (error) {
                    console.log(error);
                    this.$emit('mostrarMensaje', {
                        Code: Codigos.CodeError,
                        message: "Ocurrió un error al obtener los resultados de la votación seleccionada"
                    });
                }
            }
        }
    }
</script>