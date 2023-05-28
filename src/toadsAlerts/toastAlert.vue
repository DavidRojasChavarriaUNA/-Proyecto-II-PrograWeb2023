<template>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <p>{{mensaje}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['mensaje'],
    }
</script>