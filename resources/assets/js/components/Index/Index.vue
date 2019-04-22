<template>
	<div class="container">
		<div class="row">
			<div class="col-md-1 col-md-offset-2">Mes: </div>
			<div class="col-md-2">
				<select id="sel_mes" v-model="mesActual" class="form-control" v-on:change="selectMes">
	        <option v-for="item in wmeses" :value="item">
	          {{ item }}
	        </option>
      	</select>
			</div>
			<div class="col-md-1">
				<button class="btn btn-sm btn-primary" @click="clickProgramacion()">Programación</button>
			</div>
			<div class="col-md-1">
				<button class="btn btn-sm btn-success" @click="clickAvance()">Avance</button>
			</div>
		</div>
		<br>
		<div class="container col-md-offset-1">
			<div class="col-md-3">
				<perspectivas></perspectivas>
			</div>
			<div class="col-md-3">
				<objetivos></objetivos>			
			</div>
			<div class="col-md-3">
				<iniciativas></iniciativas>			
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				<span v-if="statusIndex.perspectiva == 'add'">				
					<div class="row">
						Agregar Perspectiva<br>
						wperspectiva:
						<input class="form-control" type="text" :value="newPerspectiva.wperspectiva">
					</div>
				</span>
				<span v-if="statusIndex.objetivo == 'add'">				
					<div class="row">
						Agregar Objetivo <br>	
						wobjetivo:
						<input class="form-control" type="text" :value="newObjetivo.wobjetivo">
						incidencia:
						<input class="form-control" type="text" :value="newObjetivo.incidencia">
					</div>
				</span>
				<span v-if="statusIndex.iniciativa == 'add'">
					<div class="row">
						Agregar Iniciativa <br>
						winiciativa: <input class="form-control" type="text" :value="newIniciativa.winiciativa">
						meta: <input type="text" class="form-control" :value="newIniciativa.meta">
						indicador: <input type="text" class="form-control" :value="newIniciativa.indicador">
						inductor: <input type="text" class="form-control" :value="newIniciativa.inductor">
						incidencia: <input type="text" class="form-control" :value="newIniciativa.incidencia">
					</div>
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
				<span v-if="statusIndex.perspectiva == 'modify'">
					<div class="row">
						Modificar Perspectiva <br>
						wperspectiva: <input class="form-control" type="text" :value="perspectiva.wperspectiva">
					</div>
				</span>
				<span v-if="statusIndex.objetivo == 'modify'">
					<div class="row">
						Modificar Objetivo <br>
						wobjetivo: <input class="form-control" type="text" :value="objetivo.wobjetivo">
						incidencia: <input class="form-control" type="text" :value="objetivo.incidencia">
					</div>
				</span>
				<span v-if="statusIndex.iniciativa == 'modify'">
					<div class="row">
						Modificar Iniciativa <br>
						winiciativa: <input class="form-control" type="text" :value="iniciativa.winiciativa">
						meta: <input type="text" class="form-control" :value="iniciativa.meta">
						indicador: <input type="text" class="form-control" :value="iniciativa.indicador">
						inductor: <input type="text" class="form-control" :value="iniciativa.inductor">
						incidencia: <input type="text" class="form-control" :value="iniciativa.incidencia">
					</div>
				</span>
			</div>
		</div>
		<div class="row">
			<span v-if="viewScreen == 'avance'">
				<avances-component :user_id="user_id" :iniciativa_id_="iniciativa_id" :mm="now" :yyyy="year"></avances-component>
			</span>
		</div>
	</div>
</template>

<script>
	import perspectivas from './Perspectivas.vue'; 	
	import objetivos from './Objetivos.vue'; 	
	import iniciativas from './Iniciativas.vue'; 	
	import { mapState, mapGetters } from 'vuex';
	export default {
    mounted() {
        console.log('Index Component mounted.');
console.log('index props: ', [this.user_id, this.iniciativa_id_, this.mm, this.yyyy]);
        this.setDataIndex();
        this.getDataIndex();
    },
    props: ['user_id', 'iniciativa_id_', 'mm', 'yyyy'],
    components: {
      perspectivas, objetivos, iniciativas
    },
    data() {
      return {
      	// viewScreen: "avance",
  			mesActual: '',
  			newPerspectiva: {
  				wperspectiva: ''
  			},
  			newObjetivo: {
  				wobjetivo: '',
  			},
  			newIniciativa: {
  				winiciativa: '',
  				meta: 0,
  				indicador: '',
  				inductor: '',
  			},
      }
    },
    computed: {
			...mapState({
				now: state => state.index.now,
				year: state => state.index.year,
				iniciativa_id: state => state.index.iniciativa_id,
				wmeses: state => state.index.wmeses,
				perspectiva: state => state.index.perspectiva,
				objetivo: state => state.index.objetivo,
				iniciativa: state => state.index.iniciativa,
				statusIndex: state => state.index.statusIndex,
				viewButtonIndex: state => state.index.viewButtonIndex,
			}),
			viewScreen(){
				if(this.iniciativa_id > 0 && this.viewButtonIndex.iniciativa == 'modify'){
					return 'avance';
				}
				return false;
			},
			...mapGetters({
			}),

    },
    methods: {
      async setDataIndex() {
// console.log('setDataIndex: ', this);
        await this.$store.commit('user_id', this.user_id);
        await this.$store.commit('iniciativaid', this.iniciativa_id_);
        await this.$store.commit('now', this.mm);
        await this.$store.commit('year', this.yyyy);
      },
    	getDataIndex: function () {
    		this.$store.dispatch('GetDataIndex');
    	},
	    selectMes: function () {
	    	this.$store.dispatch('SelectMes', this.mesActual);
	    },
	    clickProgramacion: function () {
	    	// body...
	    },
	    clickAvance: function () {
	    	// body...
	    },

	  },
	};

	function findByTipo(items, tipo) {
    for (var i in items) {
        if (items[i].tipo == tipo) {
            return i;
        }
    }
    return null;
  };
 
</script>
<style>

</style>