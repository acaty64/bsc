import Vue from 'vue';
import Vuex from 'vuex';
import index from './modules/index.js';
import avances from './modules/avances.js';
import panel from './modules/panel.js';

Vue.use(Vuex);

export const store = new Vuex.Store({
  modules: { index, avances, panel }, 
});
