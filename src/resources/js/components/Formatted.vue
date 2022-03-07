<template>
<span>{{this.formatted}}</span>
</template>

<script>
export default {
    data() {
        return {
            formatted: null,
            currencies: {
                RUB: 'Р ',
                USD: '$ ',
                EUR: 'E ',
            }
        }
    },
    props: {
        value: Number,
        type: String,
    },
    mounted() {
        if(this.type=='marketCap') {
            let tmp = 0
            if (this.value>1000000000) {
                tmp = Math.round((this.value / 1000000000) * 100) / 100 + ' млрд.'
            }
            if (this.value>1000000) {
                this.formatted = Math.round((this.value / 1000000) * 100) / 100 + ' млн.'
            }
            // if (this.value>1000000000) {
            //     this.formatted = Math.round((this.value / 1000000000) * 100) / 100 + ' млрд.'
            // }
            tmp = this.currencies[localStorage.currency]+tmp
            this.formatted = tmp
        }
        if (this.type=='price') {
            let tmp = this.value
            tmp = this.currencies[localStorage.currency]+tmp
            this.formatted = tmp
        }

    },
    methods: {
    }
}
</script>

<style>

</style>