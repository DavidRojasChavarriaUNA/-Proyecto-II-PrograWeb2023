<template>
    <!-- Modal Eliminar-->
    <div class="modal fade" :id="`modalEliminar${posicion}`" tabindex="-1" aria-labelledby="labelEliminar" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelEliminar">Eliminar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Desea eliminar el elemento seleccionado?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="AccionEliminar" type="button" class="btn btn-danger" @click="notificarEliminarOpcion">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['posicion'],
        methods:{
            notificarEliminarOpcion(){
                this.$emit('notificarEliminarOpcion');
            }
        }
    }
</script>