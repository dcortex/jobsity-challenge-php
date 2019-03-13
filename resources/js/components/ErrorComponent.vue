<template>
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <strong>Error ({{code}})</strong> {{message}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['level', 'code', 'message'],
        mounted() {
            console.log('ErrorComponent mounted.');
        }
    }
</script>
