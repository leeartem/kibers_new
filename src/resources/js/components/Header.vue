<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <a class="logo ro" href="#">KIBERS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <div class="announcement__message me-auto ">
            <span class="announcement__emoji">💵</span>
            <span>Анонс последней новости</span>
          </div>
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <router-link class="nav-link active" to="/">Криптовалюты</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/exchanges">Биржа (скоро) </router-link>
            </li>
          </ul>
          
        </div>
      </div>
    </nav>
    <Marquee />
  </div>
</template>

<script>
import Marquee from '../components/Marquee.vue'
export default {
  components: {
    Marquee,
  },
}
</script>

<style scope lang="stylus">
  .navbar
    // border-bottom: 1px solid #cee1ff
    background: linear-gradient(89.86deg, #FF551F 0.04%, #FF551F 0.05%, #FF1F55 14.06%, #FF6827 57.27%, #FFAD0E 93.4%);
    min-height: 90px
  .announcement__message
    vertical-align: middle;
    font-size: .9rem;
    line-height: 1.6;
    color: #fff;
    font-weight: 500;
    letter-spacing: 0.032em;
    white-space: nowrap;
    text-align: left;
    overflow: hidden;
    text-overflow: ellipsis;
    flex-grow: 1;
  .announcement__emoji
    margin-right .5rem
  .logo
    grid-area: logo;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding: 10px;
    text-decoration: none;
    white-space: nowrap;
    cursor: pointer;
    background: transparent;
    border: 0;
    line-height: 1;
    font-size: 2rem;
    color: #fff;
    vertical-align: middle;
    letter-spacing: 0;
    font-weight: 600;
    color: #fff;
    margin-right: 1rem
    letter-spacing: 2px;
.navbar-nav  .nav-link
  padding-top: 5px
  padding-bottom: 5px
  padding-left: 25px !important
  position relative
  &.active
    background-color: #000
    &:before
      content: ">"
      position absolute
      left: 10px
.nav-item
 display: flex
 align-items: center
</style>