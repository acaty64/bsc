import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
  
  state: {
    wmessage1: '',
    wmessage2: '',
    rol: '',
    archivoTemp: '',
    status: 'view',
    roles: {
      admin: {
        view: true,
        add: true,
        modify: true,
        viewModify: true,
        published: true,
        checked: true,
      },
      operator: {
        view: true,
        add: true,
        modify: true,
        viewModify: true,
        published: true,
        checked: false,
      },
      reviser: {
        view: true,
        add: false,
        modify: false,
        viewModify: false,
        published: false,
        checked: true,
      },
      viewer: {
        view: true,
        add: false,
        modify: false,
        viewModify: false,
        published: false,
        checked: false,
      },
    },
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
        id: 0,
				user_id: 0,
				iniciativa_id: 0,
				ejecutado: 0,
				mes: new Date().getMonth() + 1,
				warchivo: "",
				archivo: "",
        published: false,
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
    wmessage1(state, value){ state.wmessage1 = value; },
    wmessage2(state, value){ state.wmessage2 = value; },
    rol(state, value){ state.rol = value; },
		status(state, value){
      let check = state.roles[state.rol][value];
      if(check){
        state.status = value; 
      }      
    },
    user_id(state, id){
      state.user_id = id; 
      state.avanceDefault.user_id = id;
    },
    iniciativa_id(state, id){ 
      state.iniciativa_id = id;
      state.avanceDefault.iniciativa_id = id; 
    },
    avances(state, value){ state.avances = value; },
		programacion(state, value){ state.programacion = value; },
		iniciativa(state, value){ state.iniciativa = value; },
		objetivo(state, value){ state.objetivo = value; },
		perspectiva(state, value){ state.perspectiva = value; },
		programado(state, value){ state.programado = value; },
    ejecutadoMes(state, value){ state.ejecutadoMes = value; },
		ejecutado(state, value){ state.ejecutado = value; },
		avanceMes(state, value){ state.avanceMes = value; },
		// swButton(state, value){ state.swButton = value; },
    mes(state, value){ state.mes = value; },
    add(state, value){ state.add = value; },
    archivo(state, value){ state.avanceMes.archivo = value; },
    published(state, value){ state.avanceMes.published = value; },
    archivoTemp(state, value){ state.archivoTemp = value; },
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
    SaveFileTemp: function (context, request) {
      let data = new FormData();
      data.append('filePDF', request.filePDF);
      let url = context.state.protocol+'//'+context.state.URLdomain+'/api/avances/storeFileTemp';
      axios.post(url, data, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(response=>{
console.log('SaveFileTemp response.data.archivo: ', response.data.archivo);
        var filepath = response.data.archivo;
        var filenameWithExtension = filepath.replace(/^.*[\\\/]/, '');
        var filename = '/storage/temporal/'+filenameWithExtension;
        context.commit('archivoTemp', context.state.protocol+'//'+context.state.URLdomain+filename);
console.log('SaveFileTemp this.archivoTemp: ', this.archivoTemp);
        return true;
      }).catch(function (error) {
        console.log('SaveFileTemp: ',error);
      });    
    },
    SavePublished: function (context) {
      let id = context.state.avanceMes.id;
      let url = context.state.protocol+'//'+context.state.URLdomain+'/api/avances/published/'+id;
      axios.get(url)
      .then(response=>{
      }).catch(function (error) {
        console.log('store.js action SavePublished error'); 
      });
    },
    ClickButton: function (context, status) {
      context.commit('status', status);
    },
    SaveData: function (context, request) {
      let data = new FormData();
      data.append('id', context.state.avanceMes.id);
      data.append('filePDF', request.filePDF);
      let url = context.state.protocol+'//'+context.state.URLdomain+'/api/avances/storeFile';
      axios.post(url, data, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(response=>{
        context.commit('archivo', response.data.archivo);
        var request = context.state.avanceMes;
        let url = context.state.protocol+'//'+context.state.URLdomain+'/api/avances/store';
        axios.post(url, request).then(response=>{
          context.dispatch('GetData', context.state.iniciativa_id);
          return true;
        }).catch(function(error){
          console.log('SaveData 2 error: ', error);
        });
      }).catch(function (error) {
        console.log('SaveData 1: ',error);
      });    

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
      // var request = {
      //   'iniciativa_id': iniciativa_id,
      // };
      var url = context.state.protocol+'//'+context.state.URLdomain+'/api/avances/getData/'+iniciativa_id;
      axios.get(url).then(response=>{
// console.log('GetData response:', response.data.data);
      	context.commit('rol', response.data.data.rol);
        context.commit('avances', response.data.data.avances);
        context.commit('programacion', response.data.data.programacion);
        context.commit('iniciativa', response.data.data.iniciativa);
        context.commit('objetivo', response.data.data.objetivo);
        context.commit('perspectiva', response.data.data.perspectiva);
        context.commit('programado', response.data.data.programado);
        context.commit('ejecutadoMes', response.data.data.ejecutado);
        context.commit('ejecutado', response.data.data.ejecutado);
        if(isEmpty(response.data.data.avanceMes)){
          context.commit('avanceMes', context.state.avanceDefault);
          context.commit('status', 'add');
        }else{
          context.commit('avanceMes', response.data.data.avanceMes);
          if(response.data.data.avanceMes.published){
            context.commit('status', 'published');
          }else{
            context.commit('status', 'modify');
          }
        }
        if(response.data.data.published){
          context.commit('status', 'published');
          context.commit('status', 'checked');
          context.commit('wmessage1', '(Publicado)');
        }else{
          context.commit('wmessage1', '(No Publicado)');
        }
        if(response.data.data.checked){
          context.commit('status', 'complete');
          context.commit('wmessage2', "(Verificado)");
        }else{
          context.commit('wmessage2', "(No Verificado)");
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