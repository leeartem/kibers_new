<template>
  <div>
    <v-hero title="Курсы криптовалют"></v-hero>
    <div class="container">
      
    <div class="coins_table">
      <table class="coins table">
        <thead>
          <tr>
            <th class="thead__cell">Криптовалюта</th>
            <th class="thead__cell">Цена</th>
            <th class="thead__cell">Рыночная капитализация</th>
            <th class="thead__cell">24 ч</th>
          </tr>
        </thead>
        
        <tbody v-show="this.ready">
          <tr v-for="coin in coins" :key="coin.uuid">
            <td class="table__cell">
              <div class="flex coin_info">
                <span class="coin_info-rank">{{coin.rank}}</span>
                <span class="coin_info-logo">
                  <img :src="coin.iconUrl" width="26" height="26" class="profile__logo">
                </span>
                <span class="coin_info-name">
                  <router-link to="/coin/Qwsogvtv82FCd" class="coin_info-link">{{coin.name}}</router-link>
                  <span class="coin_info-subtitle">{{coin.symbol}}</span>
                </span>
              </div>
            </td>
            <td class="table__cell">
              <div class="valuta"><Formatted :value="coin.price" type="price" /></div>
            </td>
            <td class="table__cell">
              <div class="valuta"><Formatted :value="coin.marketCap" type="marketCap" /></div>
            </td>
            <td class="table__cell">
              <div class="change">
                <span class="change-value" :class="'change-value-negative-'+coin.changeNegative">{{coin.change}}%</span>
                <little-chart :id="coin.uuid" :changeNegative="coin.changeNegative" :sparkline="coin.sparkline"> </little-chart>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <b-spinner v-if="!ready" variant="primary" class="m-auto flex"></b-spinner>
      </div>
      <GeneralStats />
    </div>
  </div>
</template>

<script>
import GeneralStats from '../components/GeneralStats.vue'
import Formatted from '../components/Formatted.vue'
export default {
  data() {
    return {
      coins: [],
      ready: false,
      
    }
  },
  components: {
    GeneralStats,
    Formatted,
  },
  methods: {
    loadData() {
      this.ready = false;
      let currency = localStorage.currency
      let timePeriod = localStorage.timePeriod
      // let params = {
      //   currency: localStorage.currency,
      //   timePeriod: localStorage.timePeriod
      // }
      // console.log(params);
      axios
      .get('http://localhost/api/coins?currency='+currency+'&timePeriod='+timePeriod)
      .then(response => {this.coins = response.data;})
      .then(() => {
        // console.log(response.data);
        this.ready = true;
      });
    },
  },
  mounted() {
    this.loadData();

    // api.ListEvents({
    //     currency: this.$route.query.currency
    // }).then((res) => {
    //     this.results = res.events;
    //     this.isLoading = false;
    // }).catch(() => {
    //     this.isLoading = false;
    // });
    
  },
  watch: {
      '$route.query.currency'() {
          this.loadData();;
      }
  },
}
</script>

<style>

</style>