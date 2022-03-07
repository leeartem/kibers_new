import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

const state = {
    currency: "RUB",
}
export default new Vuex.Store({
  state
})