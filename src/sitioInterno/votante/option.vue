<template>
    <section class="col-md-3 border p-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <img :src="opcion.rutaImagen" class="img-polaroid profile-img img-thumbnail " />
            </div>

            <div class="col-md-12  text-center">

                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 class="text-primary">
                            {{opcion.nombre}}
                        </h2>
                        <p class="fw-light">
                            {{opcion.descripcion}}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="radio" class="btn-check" name="opcionSeleccionada" :id="`radio${opcion.id}`"
                            autocomplete="off" v-on:change="NotificarOpcionSeleccionada(opcion.id, `lblOpcion${opcion.id}`)">
                        <label :id="`lblOpcion${opcion.id}`" class="btn btn-outline-primary width-100 opcionVoto" :for="`radio${opcion.id}`">Seleccionar</label>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['opcion'],
        methods:{
            NotificarOpcionSeleccionada(idOpcionSeleccionada, idEtiqueta){
                const etiquetasOpcionesVoto = document.querySelectorAll('.opcionVoto');
                etiquetasOpcionesVoto.forEach(e => e.innerHTML = "Seleccionar");
                const lblEtiquetaSeleccionada = document.querySelector(`#${idEtiqueta}`);
                lblEtiquetaSeleccionada.innerHTML = "Seleccionado";
                this.$emit('seleccionarOpcion',idOpcionSeleccionada);
            }
        }
    }
</script>