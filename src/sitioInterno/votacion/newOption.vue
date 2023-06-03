<template>
    <div class="col-md-3 border p-5 NuevaOpcion">
        <div class="row width-100">
            <div class="col-md-12  text-center">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <i class="bi bi-plus-circle-fill text-success fs-1"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-success width-100"
                            v-on:click="agregarNuevaOpcion">Nuevo</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            agregarNuevaOpcion() {
                this.$emit('agregarNuevaOpcion', true);
            }
        }
    }
</script>