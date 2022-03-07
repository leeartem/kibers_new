<template>
  <div class="super-options col-4">
      <select class="super-select" @change="setCurrency($event)">
        <option value="RUB" :selected="this.currency=='RUB'">RUB</option>
        <option value="USD" :selected="this.currency=='USD'">USD</option>
        <option value="EUR" :selected="this.currency=='EUR'">EUR</option>
      </select>
      <select class="super-select" v-if="this.$route.name=='coin'">
        <option value="3h" :selected="this.currency=='3h'">3 час.</option>
        <option value="24h" :selected="this.currency=='24h'">24 час.</option>
        <option value="7d" :selected="this.currency=='7d'">7 дней</option>
        <option value="30d" :selected="this.currency=='30d'">30 дней</option>
        <option value="3m" :selected="this.currency=='3m'">3 мес.</option>
        <option value="1y" :selected="this.currency=='1y'">1 год</option>
        <option value="3y" :selected="this.currency=='3y'">3 года</option>
        <option value="5y" :selected="this.currency=='5y'">5 лет</option>
      </select>
    </div>
</template>

<script>
export default {
    data() {
        return {
            currency: localStorage.currency,
            timePeriod: localStorage.timePeriod,
        }
    },
    methods: {
    setCurrency(event) {
      if(event.target.value!=localStorage.currency) {
          localStorage.currency = event.target.value
          this.$router.push(this.$route.path+'?currency='+event.target.value)
      }
    },
  },
  mounted() {
  },
}
</script>

<style>

</style>