<template>
    <nav class="nav">
        <div class="container">
            <div class="d-flex">
                <router-link :to="{ name: 'village' }">Village</router-link>
                <router-link :to="{ name: 'map' }">Map</router-link>
            </div>
        </div>
    </nav>
</template>

<style scoped lang="scss">
    @import './../../../sass/vendor/_variables.scss';

    .nav {
        box-shadow: 0 1px 1px 0 rgba($dark, .1);

        a {
            display: block;
            padding: 1rem;
            line-height: 20px;
            color: $primary;
            text-decoration: none;
        }
    }
</style>
