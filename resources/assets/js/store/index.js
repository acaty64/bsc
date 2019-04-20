import Vue from 'vue';
import Vuex from 'vuex';
import main from './modules/main.js';
import avances from './modules/avances.js';
import panel from './modules/panel.js';

Vue.use(Vuex);

export const store = new Vuex.Store({
  modules: { main, avances, panel }, 
});
