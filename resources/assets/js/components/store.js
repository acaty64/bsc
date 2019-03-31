import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
  
  state: {
    add: true,
    swButton: 'add',
    URLdomain: window.location.host,
    protocol: window.location.protocol,   
    iniciativa_id: 0,
    user_id: 0,
    avances: [],
    avanceMes: {},
    programacion: [],
    iniciativa: [],
    objetivo: [],
    perspectiva: [],
    documento: "",
    programado: [],
    ejecutado: [],
    ejecutadoMes: [],
    mes: {
        ejecutado: 0,
        programado: 0
      },
    now: new Date().getMonth() + 1,
		avanceDefault: {
        id: 'new',
				user_id: this.user_id,
				iniciativa_id: this.iniciativa_id,
				ejecutado: 0,
				mes: new Date().getMonth() + 1,
				warchivo: "",
				archivo: ""
			},
    wmes: [
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
	},
	mutations: {
		user_id(state, id){ state.user_id = id; },
		iniciativa_id(state, id){ state.iniciativa_id = id; },
		avances(state, value){ state.avances = value; },
		programacion(state, value){ state.programacion = value; },
		iniciativa(state, value){ state.iniciativa = value; },
		objetivo(state, value){ state.objetivo = value; },
		perspectiva(state, value){ state.perspectiva = value; },
		programado(state, value){ state.programado = value; },
    ejecutadoMes(state, value){ state.ejecutadoMes = value; },
		ejecutado(state, value){ state.ejecutado = value; },
		avanceMes(state, value){ state.avanceMes = value; },
		swButton(state, value){ state.swButton = value; },
    mes(state, value){ state.mes = value; },
		add(state, value){ state.add = value; },
	},
	getters: {
    colorIniciativa (state) {
      var ejec = state.ejecutado.iniciativa;
      var prog = state.programado.iniciativa;
      return color(ejec, prog);
    },
    colorObjetivo (state) {
      var ejec = state.ejecutado.objetivo;
      var prog = state.programado.objetivo;
      return color(ejec, prog);
    },
    colorPerspectiva (state) {
      var ejec = state.ejecutado.perspectiva;
      var prog = state.programado.perspectiva;
      return color(ejec, prog);
    },
  },
  actions: {
    SaveData: (context, request) => {
console.log('SaveData: ', request);      
    },
    NewAvance: (context, value) =>{
      var newValue = context.state.avanceMes;
      newValue.ejecutado = value;
      context.dispatch('ChangeEjecutado', value);
      context.dispatch('GetMes');
    },
    ChangeAvance: (context, value) => {
      var oldValue = context.state.avances;
      for (var i = oldValue.length - 1; i >= 0; i--) {
        if(oldValue[i].id == value.id){
          oldValue[i] = value;
          context.commit('avances', oldValue);
        }
      }
    },
    ChangeEjecutado: (context, newValue) => {
      if(!isEmpty(context.state.programado)){
        var oldValue = context.state.avanceMes.ejecutado;
        var meta = context.state.iniciativa.meta;
        var incidenciaIniciativa = context.state.iniciativa.incidencia;
        var incidenciaObjetivo = context.state.objetivo.incidencia;

        var preValue = context.state.ejecutadoMes.iniciativa;
        var newEjecutadoIniciativa = preValue - (oldValue/meta*100) 
                                              + (newValue/meta*100);

        var preValue = context.state.ejecutadoMes.objetivo;
        var newEjecutadoObjetivo = preValue - ((oldValue/meta*100)*(incidenciaIniciativa/100)) 
                                              + ((newValue/meta*100)*(incidenciaIniciativa/100)); 

        var preValue = context.state.ejecutadoMes.perspectiva;
        var newEjecutadoPerspectiva = preValue - ((oldValue/meta*100)*(incidenciaIniciativa/100)*(incidenciaObjetivo/100)) 
                                              + ((newValue/meta*100)*(incidenciaIniciativa/100)*(incidenciaObjetivo/100)); 

        var newEjecutado = {
          iniciativa: newEjecutadoIniciativa,
          objetivo: newEjecutadoObjetivo,
          perspectiva: newEjecutadoPerspectiva
        }
        context.commit('ejecutado', newEjecutado);

        var newMes = context.state.mes;
        newMes.ejecutado = newValue;
        context.commit('mes', newMes);
      }
    },
    GetData: (context, iniciativa_id) => {  
      var request = {
        'iniciativa_id': iniciativa_id,
      };
      var url = context.state.protocol+'//'+context.state.URLdomain+'/api/avances/getData';
      axios.post(url, request).then(response=>{
      	context.commit('avances', response.data.data.avances);
        context.commit('programacion', response.data.data.programacion);
        context.commit('iniciativa', response.data.data.iniciativa);
        context.commit('objetivo', response.data.data.objetivo);
        context.commit('perspectiva', response.data.data.perspectiva);
        context.commit('programado', response.data.data.programado);
        context.commit('ejecutadoMes', response.data.data.ejecutado);
        context.commit('ejecutado', response.data.data.ejecutado);
        context.commit('avanceMes', context.state.avanceDefault);
        if(!isEmpty(response.data.data.avanceMes)){
          context.commit('avanceMes', context.state.avanceMes);
          context.commit('swButton', 'modify');
          context.commit('add', false);
        }
        context.dispatch('GetMes');
      }).catch(function (error) {
        console.log('getData: ',error);
      });
    },
    GetMes: (context) => {
      var ejecutado = 0;
      for (var i = context.state.avances.length - 1; i >= 0; i--) {
        if(context.state.avances[i].mes == context.state.now){
          var ejecutado = context.state.avances[i].ejecutado;
          context.commit('avanceMes', context.state.avances[i]);
        }
      }
      var programado = 0;
      for (var i = context.state.programacion.length - 1; i >= 0; i--) {
        if(context.state.programacion[i].mes == context.state.now){
          var programado = context.state.programacion[i].programado;
        }
      }
      var mes = {
      	'ejecutado': ejecutado,
      	'programado': programado 
      }
      context.commit('mes', mes);
    },

	},
});

function findByTipo(items, tipo) {
        for (var i in items) {
            if (items[i].tipo == tipo) {
                return i;
            }
        }
        return null;
    }

function isEmpty(obj) {
        for (var key in obj) {
          if(obj.hasOwnProperty(key))
            return false;
        }
        return true;
      }; 

function color(ejec, prog) {
  if(ejec/prog >= 0.95){
      return 'lime';
  }
  if(ejec/prog >= 0.5 && ejec/prog < 0.95){
      return 'yellow';
  }
  if(ejec/prog < 0.5){
      return 'red';
  }
}