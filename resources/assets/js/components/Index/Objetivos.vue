<template>
	<div class="container">
		<div class="col-md-3">
			<div class="row">Objetivos
				<span v-if="viewButtonIndex.objetivo == 'add'">			
					<button class="btn btn-sm btn-primary" @click="clickAdd">Agregar</button>
				</span>
				<span v-if="viewButtonIndex.objetivo == 'saveAdd' || viewButtonIndex.objetivo == 'saveModify'">			
					<button class="btn btn-sm btn-primary" @click="clickSave">Grabar</button>
					<button class="btn btn-sm btn-success" @click="clickCancel">Cancelar</button>
				</span>
				<span v-if="viewButtonIndex.objetivo == 'modify'">
					<button class="btn btn-sm btn-success" @click="clickModify">Modificar</button>
					<button class="btn btn-sm btn-danger" @click="clickDelete">Eliminar</button>
				</span>
			</div>
			<div class="row">
				<select id="sel_objetivo" v-model="opcion" class="form-control" v-on:change="selectOption(opcion.id)">
	      	<option v-for="item in _objetivos" :value="item">
		        	{{ item.wobjetivo }}
	      	</option>
		  	</select>	  		  	
		  </div>
	  </div>
	</div>
</template>

<script>
	import { mapState, mapGetters } from 'vuex';
	export default {
		data(){
			return {
				opcion: {},
			}
		},
		computed: {
			...mapState({
				objetivo: state => state.index.objetivo,
				viewButtonIndex: state => state.index.viewButtonIndex,
			}),
			...mapGetters({
				_objetivos: '_objetivos', 
			}),
		},
		methods: {
			selectOption: function (id) {
				this.$store.dispatch('SelectObjetivo', this.opcion);
				this.$store.dispatch('SelectIniciativa', {});
				this.$store.commit('objetivo_id', id);
				this.$store.commit('iniciativa_id', 0);

				this.$store.dispatch('SetStatus', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'iniciativa', status: 'none'});
				
				this.$store.dispatch('SetViewButtonIndex', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'objetivo', status: 'modify'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'iniciativa', status: 'add'});

			},
			clickAdd: function () {

				this.$store.dispatch('SetStatus', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'objetivo', status: 'add'});
				this.$store.dispatch('SetStatus', {type: 'iniciativa', status: 'none'});
				
				this.$store.dispatch('SetViewButtonIndex', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'objetivo', status: 'saveAdd'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'iniciativa', status: 'none'});
			},
			clickModify: function () {

				this.$store.dispatch('SetStatus', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'objetivo', status: 'modify'});
				this.$store.dispatch('SetStatus', {type: 'iniciativa', status: 'none'});
				
				this.$store.dispatch('SetViewButtonIndex', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'objetivo', status: 'saveModify'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'iniciativa', status: 'none'});
			},
			clickCancel: function () {
				this.$store.dispatch('SetStatus', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'iniciativa', status: 'none'});
				
				this.$store.dispatch('SetViewButtonIndex', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'objetivo', status: 'add'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'iniciativa', status: 'none'});
			},
			clickDelete: function () {

				this.clickCancel();
			},
			clickSave: function () {

				this.clickCancel();
			},

		},
	};


</script>