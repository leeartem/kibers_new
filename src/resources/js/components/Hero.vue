<template>
<div class="container">
  <div class="row flex-end">
    <div class="hero hero--light col-8">
      <div class="hero__header">
        <h1 class="hero__title">{{title}}</h1>
      </div>
    </div>
    <Filters />
  </div>
</div>
</template>

<script>
import Filters from '../components/Filters.vue'
export default {
  props: {
      title: {
          type: String,
          default: "NULL"
      },
      options: {
        type: Boolean,
      }
  },
  components: {
    Filters,
  },
  
}
</script>

<style scope lang="stylus">
  .hero
    margin-top 3rem
  .hero__title
    font-size: 3.2rem;
    font-weight: 400;
    color: #fff;
    letter-spacing: .025em;
    // text-align: center;
    line-height: 1.3;
    margin: 1rem 0;
</style>