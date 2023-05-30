<template>
    <!-- Confirmation Modal -->
    <form>
        <section class="modal fade" id="modalConfirmarVotacion" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmación de Votación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <div class="col-md-6 border p-5 align-middle">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <img :src="opcionSeleccionada.rutaImagen" class="img-polaroid profile-img img-thumbnail " />
                                </div>

                                <div class="col-md-12  text-center">

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h2 class="text-primary">
                                                {{opcionSeleccionada.nombre}}
                                            </h2>
                                            <p class="fw-light">
                                                {{opcionSeleccionada.descripcion}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-outline-success" @click="NotificarVotacionConfirmada">Realizar Votación</button>
                    </div>
                </div>
            </div>
        </section>
    </form>
</template>

<script>
    export default {
        props: ['opcionSeleccionada'],
        methods:{
            NotificarVotacionConfirmada(){
                this.$emit('realizarVotacion');
            }
        }
    }
</script>