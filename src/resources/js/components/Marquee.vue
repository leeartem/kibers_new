<template>
  <div class="marquee">
      <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
          <span>Топ 10 валют: </span>
          <span class="positive">BTC - $43 000</span>
          <span class="negative">ETH - $3 000</span>

          <span class="positive">BTC - $43 000</span>
          <span class="positive">ETH - $3 000</span>
          <span class="positive">BTC - $43 000</span>
          <span class="negative">ETH - $3 000</span>
          <span class="positive">BTC - $43 000</span>
          <span class="negative">ETH - $3 000</span>
          <span class="negative">BTC - $43 000</span>
      </marquee>
  </div>
</template>

<script>
export default {

}
</script>

<style>
    .marquee {
        background-color: #000;
        color: #fff;
        display: flex;
        align-content: center;
    }
    marquee {
        display: flex;
        align-content: center;
        
        padding: 15px;
    }
    .marquee span {
        font-family: 'Press Start 2P', cursive !important;
        font-size: .7rem;
        margin-right: 2.5rem;
    }
    /* .positive {
        color: #43ff9c;
    }
    .negative {
        color: #ff346c;
    } */
</style>