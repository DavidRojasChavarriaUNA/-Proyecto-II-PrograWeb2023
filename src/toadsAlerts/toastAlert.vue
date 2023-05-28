<template>
    <div class="toast-container position-absolute p-3 bottom-0 end-0"
        data-original-class="toast-container position-absolute p-3" v-show="respuestaServicio.mostrarMensaje">
        <div class="toast fade show bg-toast">
            <div class="toast-header">
                <strong class="me-auto">Mensaje</strong>
                <button type="button" class="btn-close" v-on:click="ocultar"></button>
            </div>
            <div class="toast-body">
                <p>{{respuestaServicio.Code}} - {{respuestaServicio.message}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['respuestaServicio'],
        methods: {
            ocultar() {
                this.respuestaServicio.mostrarMensaje = false;
            }
        }
    }
</script>