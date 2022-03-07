<template>
    <div class="home">
        <v-header> </v-header>
        <router-view></router-view>
        <v-footer />
    </div>
</template>
<script>
    export default {
        mounted() {
            if (!localStorage.currency) {
                localStorage.currency = "RUB"
            }
            if (!localStorage.timePeriod) {
                localStorage.timePeriod = "24h"
            }
        },
    }
</script>
