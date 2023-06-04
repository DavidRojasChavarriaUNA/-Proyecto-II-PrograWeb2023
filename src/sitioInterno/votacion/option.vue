<template>
    <div class="col-md-3 border p-5 Opcion">
        <input type="hidden" :value="opcion.id" />
        <div class="row">
            <div class="col-md-12 text-center">
                <label class="form-label text-primary  mt-2">Seleccionar imagen:</label>
                <img v-if="opcion.rutaImagen" :src="opcion.rutaImagen" :id="`img${opcion.posicion}`"
                    class="imgChooser img-polaroid profile-img img-thumbnail" />
                <img v-else src="/assets/imagenes/SeleccionarImagen.png" :id="`img${opcion.posicion}`"
                    class="imgChooser img-polaroid profile-img img-thumbnail" />
                <input type="hidden" v-model="opcion.rutaImagen" :id="`rutaImagen${opcion.posicion}`" />
                <input class="form-control form-control-sm" type="file" accept="image/png, image/jpeg" AutofileChooser
                    :ImgTagIdToDisplay="`img${opcion.posicion}`"
                    :InputTagIdToStoreBase64Img="`rutaImagen${opcion.posicion}`" style="display:none;"
                    :id="`imgChooser${opcion.posicion}`">
            </div>

            <div class="col-md-12  text-center">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <label class="form-label text-primary  mt-2">Nombre:</label>
                        <input class="form-control" placeholder="Ingrese el nombre" v-model="opcion.nombre" />
                        <label class="form-label text-primary  mt-2">Descripción:</label>
                        <textarea rows="10" class="form-control fw-light" placeholder="Ingrese la descripción"
                            v-model="opcion.descripcion"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12  text-center">
                <button type="button" class="btn btn-danger width-100" data-bs-toggle="modal"
                    :data-bs-target="`#modalEliminar${opcion.posicion}`">Eliminar</button>
            </div>
        </div>
        <modal-eliminar-vue v-bind:posicion="opcion.posicion" v-on:notificarEliminarOpcion="notificarEliminarOpcion"></modal-eliminar-vue>
    </div>
</template>

<script>
    import AutoFileToBase64 from '../../js/AutoFileToBase64.js';
    import modalEliminarVue from './modalEliminar.vue';
    import * as bootstrap from 'bootstrap';

    export default {
        props: ['opcion'],
        components:{
            modalEliminarVue
        },
        data() {
            return {
                autoFileChooseAsignado: false
            };
        },
        mounted() {
            AutoFileToBase64.InitElementById(`imgChooser${this.opcion.posicion}`);
        },
        methods: {
            cerrarModalEliminar() {
                const modalEliminarElem = document.querySelector(`#modalEliminar${this.opcion.posicion}`);
                const modalEliminar = bootstrap.Modal.getInstance(modalEliminarElem);
                modalEliminar.hide();
            },
            notificarEliminarOpcion(){
                this.cerrarModalEliminar();
                this.$emit('eliminarOpcion', this.opcion.id);
            }
        }
    }
</script>