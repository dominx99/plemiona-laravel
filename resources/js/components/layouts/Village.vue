<template>
    <navbar></navbar>
</template>

<script>
    import Navbar from './../partials/Navbar';

    export default {
        components: {
            Navbar
        },
        mounted() {
            this.fetchVillage();
        }
    }
</script>
