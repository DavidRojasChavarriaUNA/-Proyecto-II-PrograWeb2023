<template>
    <div class="toast-container position-absolute p-3 bottom-0 end-0"
        data-original-class="toast-container position-absolute p-3" style="position: fixed !important;">
        <div v-for="(mensaje, index) in mensajes" :key="index" class="toast bg-toast" :id="`toast${index}`" :ref="function(elem){
            //mostramos el toas con bootsratp
            inicializarToast(elem, mensaje.id);
        }"
            role="alert" data-bs-delay="5000" data-bs-autohide="true" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Mensaje</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                <p v-html="`${mensaje.Code} - ${mensaje.message}`"></p>
            </div>
        </div>
    </div>
</template>

<script>

    import {v4 as uuidv4} from 'uuid';
    import * as bootstrap from 'bootstrap';

    export default {
        props: ['respuestaServicio'],
        data() {
            return {
                mensajes: []
            }
        },
        updated() {
            if(!this.respuestaServicio.NoMostrarMas && !this.mensajes.includes(this.respuestaServicio)){
                this.respuestaServicio.id = uuidv4();
                this.respuestaServicio.NoMostrarMas = true;
                this.mensajes.push(this.respuestaServicio);
            }
        },
        methods: {
            ocultar(id) {
                this.mensajes = this.mensajes.filter(m => m.id !== id);
            },
            inicializarToast(toastElem, idMensaje){
                if(!toastElem)
                    return;
                const vm = this;
                toastElem.addEventListener('hide.bs.toast', function () {
                    vm.ocultar(idMensaje);
                });
                const toast = bootstrap.Toast.getOrCreateInstance(toastElem);
                toast.show();
            }
        }
    }
</script>