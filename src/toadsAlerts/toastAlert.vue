<template>
    <div class="toast-container position-absolute p-3 bottom-0 end-0"
        data-original-class="toast-container position-absolute p-3">
        <div v-for="(mensaje, index) in mensajes" :key="index" class="toast fade show bg-toast" :id="`toast${index}`">
            <div class="toast-header">
                <strong class="me-auto">Mensaje</strong>
                <button type="button" class="btn-close" v-on:click="ocultar(`${mensaje.id}`)"></button>
            </div>
            <div class="toast-body">
                <p v-html="`${mensaje.Code} - ${mensaje.message}`"></p>
            </div>
        </div>
    </div>
</template>

<script>

    import {v4 as uuidv4} from 'uuid';

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
            }
        }
    }
</script>