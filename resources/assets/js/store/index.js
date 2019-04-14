import Vue from 'vue';
import Vuex from 'vuex';
import avances from './modules/avances.js';

Vue.use(Vuex);

export const store = new Vuex.Store({
  modules: { avances },
});
