export default {
  state: {
    aaa: "panel.js",
    URLdomain: window.location.host,
    protocol: window.location.protocol,
    items: {},
	},

	mutations: {
    items(state, value){ state.items = value; },
	},
	getters: {

  },
  actions: {
    GetDataPanel: (context) => {
      var url = context.state.protocol+'//'+context.state.URLdomain+'/api/panel/getData';
      axios.get(url).then(response=>{
      	context.commit('items', response.data.data);
// console.log('panel.js GetDataPanel: ', response.data.data);
      });
    },
    GetMes: (context) => {

    },
	},
};
