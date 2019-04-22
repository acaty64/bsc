export default {
  state: {
    aaa: "index.js",
    URLdomain: window.location.host,
    protocol: window.location.protocol,
  	wmeses: [
			'Enero',
			'Febrero',
			'Marzo',
			'Abril',
			'Mayo',
			'Junio',
			'Julio',
			'Agosto',
			'Setiembre',
			'Octubre',
			'Noviembre',
			'Diciembre',      		
  	],

  	now: 0,
    year: 0,
    mm: 0,
    yyyy: 0,
  	perspectiva_id: 0,
  	objetivo_id: 0,
  	iniciativa_id: 0,

    perspectivas: {},
    objetivos: {},
    iniciativas: {},

    perspectiva: {},
    objetivo: {},
    iniciativa: {},

    statusIndex: {
    	perspectiva: 'none',
    	objetivo: 'none',
    	iniciativa: 'none',
    },

    viewButtonIndex: {
    	perspectiva: 'add',
    	objetivo: 'none',
    	iniciativa: 'none',
    },

	},

	mutations: {
    now(state, value){ 
      state.now = value; 
      state.mm = value; 
    },
    year(state, value){ state.year = value; },
    perspectivas(state, value){ state.perspectivas = value; },
    objetivos(state, value){ state.objetivos = value; },
    iniciativas(state, value){ state.iniciativas = value; },
    perspectiva(state, value){ state.perspectiva = value; },
    objetivo(state, value){ state.objetivo = value; },
    iniciativa(state, value){ state.iniciativa = value; },
    perspectiva_id(state, value){ state.perspectiva_id = value; },
    objetivo_id(state, value){ state.objetivo_id = value; },
    iniciativa_id(state, value){ state.iniciativa_id = value; },
    statusIndex(state, value){
    	switch(value.type){
    		case 'perspectiva': 
    			state.statusIndex.perspectiva = value.status;
    			break;
    		case 'objetivo': 
    			state.statusIndex.objetivo = value.status;
    			break;
    		case 'iniciativa': 
    			state.statusIndex.iniciativa = value.status;
    			break;
    	} 
    },
    viewButtonIndex(state, value){
    	switch(value.type){
    		case 'perspectiva': 
    			state.viewButtonIndex.perspectiva = value.status;
    			break;
    		case 'objetivo': 
    			state.viewButtonIndex.objetivo = value.status;
    			break;
    		case 'iniciativa': 
    			state.viewButtonIndex.iniciativa = value.status;
    			break;
    	} 
    },
	},
	getters: {
    _objetivos (state, getters) {
    	var value = state.perspectiva_id;
      var result = filterPerspectivaId(state.objetivos, state.perspectiva_id);
      return result;
    },
    _iniciativas (state, getters) {
    	var value = state.objetivo_id;
      var result = filterObjetivoId(state.iniciativas, state.objetivo_id);
      return result;
    },
    _avances (state, getters) {
    	var value = state.iniciativa_id;
      var result = filterIniciativaId(state.avances, state.iniciativa_id);
      return result;
    },
    _programacion (state, getters) {
    	var value = state.iniciativa_id;
      var result = filterIniciativaId(state.programacion, state.iniciativa_id);
      return result;
    },
  },
  actions: {
    GetDataIndex: (context) => {
      var url = context.state.protocol+'//'+context.state.URLdomain+'/api/index/getDataIndex';
console.log('index.js GetDataIndex url: ', url);
      axios.get(url).then(response=>{
// console.log('index.js GetDataIndex: ', response.data.data);
      	context.commit('perspectivas', response.data.data.perspectivas);
      	context.commit('objetivos', response.data.data.objetivos);
      	context.commit('iniciativas', response.data.data.iniciativas);
      });
    },
    SelectMes: (context, mesActual) => {
    	var nMes = findNmes(context.state.wmeses, mesActual);
    	context.commit('now', nMes);
    },
    SelectPerspectiva: (context, perspectiva) => {
    	context.commit('perspectiva', perspectiva);
    },
    SelectObjetivo: (context, objetivo) => {
    	context.commit('objetivo', objetivo);
    },
    SelectIniciativa: (context, iniciativa) => {
    	context.commit('iniciativa', iniciativa);
    },
    SetStatus: (context, param) => {
    	context.commit('statusIndex', param);
    },
    SetViewButtonIndex: (context, param) => {
    	context.commit('viewButtonIndex', param);
    },
	},
};

function findNmes(items, value) {
	var nMes = 1;
  for (var i in items) {
    if (items[i] == value) {
      return nMes;
    }
    nMes++;
  }
  return null;
};

function filterPerspectivaId(items, value) {
	var result = [];
  for (var i in items) {
    if (items[i].perspectiva_id == value) {
      result.push(items[i]);
    }
  }
  return result;
};

function filterObjetivoId(items, value) {
	var result = [];
  for (var i in items) {
    if (items[i].objetivo_id == value) {
      result.push(items[i]);
    }
  }
  return result;
};

function filterIniciativaId(items, value) {
	var result = [];
  for (var i in items) {
    if (items[i].iniciativa_id == value) {
      result.push(items[i]);
    }
  }
  return result;
};
