<template>
   <!-- Modal Desactivar-->
<div class="modal fade" :id="`modalDesactivar${id}`"  tabindex="-1" aria-labelledby="labelDesactivar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelDesactivar">Desactivar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea desactivar la votación seleccionada?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="AccionDesactivar" type="button" class="btn btn-danger" @click="notificarDesactivar">Desactivar</button>
               
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props:['id'],
        methods:{
            notificarDesactivar(){
                this.$emit('notificarDesactivar');
            }
        }
    }
</script>