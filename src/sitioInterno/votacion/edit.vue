<template>
    <section id="NuevoVotacion" class="m-5">
        <article>
            <section>
                <form>
                    <h1 class="text-center">Editar votación</h1>
                    <input type="hidden" v-model="votacion.id" name="id" required>
                    <input type="hidden" v-model="votacion.idEstado" name="idEstado" required>
                    <!-- <input type="file" name="my_file"> -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fs-3 mt-2">Titulo votación:</label>
                            <input type="text" class="form-control" v-model="votacion.descripcion"
                                placeholder="Ingrese el titulo de la votación" name="descripcion">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fs-3 mt-2">Fecha y hora de apertura:</label>
                            <input type="datetime-local" class="form-control" v-model="votacion.fechaHoraInicio"
                                placeholder="ingrese una fecha y hora de inicio, en formato YYYY-MM-DD HH:MM:SS.SSS"
                                name="fechaHoraInicio">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fs-3 mt-2">Fecha y hora de cierre</label>
                            <input type="datetime-local" class="form-control" v-model="votacion.fechaHoraFin"
                                placeholder="ingrese una fecha y hora de cierre, en formato YYYY-MM-DD HH:MM:SS.SSS"
                                name="fechaHoraFin">
                        </div>
                    </div>
                    <h3 class="text-secondary mt-3 mb-3">Listado de opciones</h3>
                    <div class="container">
                        <div class="row bg-white" id="ListaOpcionesAgregar">
                            <!-- Listado de opciones -->
                            <option-vue v-for="(opcion, index) in votacion.opciones" 
                                        v-bind:key="opcion.id"
                                        v-bind:opcion="opcion" 
                                        v-on:eliminarOpcion="eliminarOpcion" 
                                        v-model="opcion[index]">
                            </option-vue>
                            <!-- Nueva opción -->
                            <new-option-vue v-on:agregarNuevaOpcion="agregarNuevaOpcion"></new-option-vue>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto mt-5">
                            <button type="button" class="btn btn-outline-success" id="GuardadoExitosoBtn" v-on:click="modificarVotacion">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </article>
    </section>
</template>

<script>
    import { Codigos } from '../../js/sitioInterno';
    import { v4 as uuidv4 } from 'uuid';
    import newOptionVue from './newOption.vue';
    import optionVue from '../votacion/option.vue';

    const urlBase = import.meta.env.VITE_BASE_URL;
    const RutaImagenDefault = import.meta.env.VITE_BASE_RUTA_IMAGEN_DEFAULT;

    export default {
        data() {
            return {
                idUsuario: 0,
                votacion: null,
                idVotacion: 0,
                opciones: [],
                opc:[],
            }
        },
        components: {
            optionVue,
            newOptionVue
        },
        created() {
            this.InicializarData();
        },
        methods: {
            InicializarData() {
                this.idUsuario = this.$route.params.idUsuario;
                this.idVotacion = this.$route.params.idVotacion;
                this.editarVotacion(this.idVotacion);
            },
            redireccionarLista() {
                this.$router.push(`/votaciones/${this.idUsuario}`); //

            },
            async editarVotacion(idV) {
                try {
                    const respuestaHttp = await fetch(`${urlBase}/votacion/${idV}/edit`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    console.log(respuestaHttp);
                    const datosVotacion = await respuestaHttp.json();
                    console.log(datosVotacion);
                    if (datosVotacion && (datosVotacion.Code == Codigos.CodeSuccess)) {
                    this.votacion = datosVotacion.votacion;
                        this.opciones = this.votacion['opciones'];
                        
                        this.votacion = null;
                        for (var i = 0; i < this.opciones.length; i++) {
                            
                            this.opc[i] = {
                                id: this.opciones[i]['id'],
                                nombre: this.opciones[i]['nombre'],
                                descripcion: this.opciones[i]['descripcion'],
                                rutaImagen: this.opciones[i]['rutaImagen'],
                                idVotacion: this.opciones[i]['idVotacion'],
                                opcionNueva: 'No',
                                posicion: this.opciones[i]['posicion']
                            }
                        }
                        this.votacion = {
                            id: datosVotacion.votacion['id'],
                            idEstado: datosVotacion.votacion['idEstado'],
                            descripcion: datosVotacion.votacion['descripcion'],
                            fechaHoraInicio: datosVotacion.votacion['fechaHoraInicio'],
                            fechaHoraFin: datosVotacion.votacion['fechaHoraFin'],
                            opciones: this.opc,
                            idsOpcionesEliminar: []
                        }
                        
                    } else {
                        this.$emit('mostrarMensaje', datosVotacion);
                    }
                } catch (error) {
                    console.log(error);
                    this.$emit('mostrarMensaje', { Code: Codigos.CodeError, message: "Ocurrió un error al obtener la votación", error });
                }
            },
            obtenerSiguientePosicion() {
                if (!this.votacion.opciones || this.votacion.opciones.length === 0)
                    return 1;
                const posiciones = this.votacion.opciones.map(o => o.posicion);
                return Math.max(...posiciones) + 1;
            },
            crearNuevaOpcion() {
                const opcion = {
                    id: uuidv4(),
                    nombre: '',
                    descripcion: '',
                    rutaImagen: RutaImagenDefault,
                    idVotacion: this.votacion.id,
                    posicion: this.obtenerSiguientePosicion(),
                    opcionNueva: 'Si'
                }
                return opcion;
            },
            agregarNuevaOpcion(mostrarMensaje = false) {
                this.votacion.opciones.push(this.crearNuevaOpcion());
                if (mostrarMensaje) {
                    this.$emit('mostrarMensaje', { Code: Codigos.CodeSuccess, message: "Opción agregada" });
                }
            },
            eliminarOpcion(idOpcion) {
                const opcion = this.votacion.opciones.find(o => o.id === idOpcion);
                if(!opcion)
                    return;
                this.votacion.opciones = this.votacion.opciones.filter(o => o.id !== idOpcion);
                this.votacion.opciones.sort((a, b) => a.posicion - b.posicion);
                if(opcion.opcionNueva === 'No')
                    this.votacion.idsOpcionesEliminar.push(idOpcion);
            },
            async modificarVotacion() {
                try {
                    const url = `${urlBase}/votacion/${this.idVotacion}`;

                    const respuestaHttp = await fetch(url, {
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        method: 'POST',
                        body: JSON.stringify(this.votacion)
                    });
                    const datosVoto = await respuestaHttp.json();
                    this.$emit('mostrarMensaje', datosVoto);
                    if (datosVoto && (datosVoto.Code == Codigos.CodeSuccess)) {
                        this.redireccionarLista();
                    }
                } catch (error) {
                    console.log(error);
                    this.$emit('mostrarMensaje', {
                        Code: Codigos.CodeError,
                        message: "Ocurrió un error al modificar la votación"
                    });
                }
            }
        }
    }
</script>