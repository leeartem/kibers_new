<template>
  <div class="stats">
        <div class="stats__top">
            <h3 class="title">Статистика рынка криптовалют</h3>
            <p class="stats__description">
            Обзор всего рынка криптовалют, включая количество криптовалют, общую капитализацию рынка и объем торгов.
            </p>
        </div>
        <b-spinner v-if="!ready" variant="primary" class="m-auto flex"></b-spinner>
        <table v-else class="stats_table">
            <tr class="stats__item">
                <td class="stats__icon"></td>
                <th class="stats__label">
                    <span class="stats__label-text">Капитализация рынка криптовалют</span>
                </th>
                <td class="stats__value">{{currency}} {{generalStats.totalMarketCap}}</td>
            </tr>
            <tr class="stats__item">
                <td class="stats__icon"></td>
                <th class="stats__label">
                    <span class="stats__label-text">Объем за 24 ч</span>
                </th>
                <td class="stats__value">{{currency}} {{generalStats.total24hVolume}}</td>
            </tr>
            <tr class="stats__item">
                <td class="stats__icon"></td>
                <th class="stats__label">
                    <span class="stats__label-text">Криптовалют</span>
                </th>
                <td class="stats__value">{{generalStats.totalCoins}}</td>
            </tr>
            <tr class="stats__item">
                <td class="stats__icon"></td>
                <th class="stats__label">
                    <span class="stats__label-text">Все биржи криптовалют</span>
                </th>
                <td class="stats__value">{{generalStats.totalExchanges}}</td>
            </tr>
            <tr class="stats__item">
                <td class="stats__icon"></td>
                <th class="stats__label">
                    <span class="stats__label-text">Все рынки криптовалют</span>
                </th>
                <td class="stats__value">{{generalStats.totalMarkets}}</td>
            </tr>
        </table>
  </div>
</template>

<script>
export default {
    data() {
    return {
      ready: false,
      generalStats: [],
      currency: localStorage.currency
    }
  },
    mounted() {
        axios
        .get('http://localhost/api/general', {currency : localStorage.currency})
        .then(response => {this.generalStats = response.data; console.log(this.generalStats);this.ready=true;});
    }
}
</script>

<style lang="stylus">
.stats__top
    margin-bottom: 1rem
.stats__item
    display: grid;
    // border-bottom: 1px solid #173e7b;
    padding: 16px 0 18px;
    grid-template-columns: 48px auto auto;
    grid-template-rows: auto auto;
    align-items: center;
    // border-color: #cee1ff;
    border-bottom: 1px solid rgba(35,39,52,0.1)
.stats__label-text
    font-size: 1rem;
    color: #111;
    text-align: left;
    font-weight: 500;
    margin-right: 10px;
.stats__value
    font-size: 1rem;
    color: #000;
    font-weight: 700;
    text-align: right;
    white-space: nowrap;
.stats_table
 width: 100%
</style>