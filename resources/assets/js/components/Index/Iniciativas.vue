<template>
	<div class="container">
		<div class="col-md-3">
			<div class="row">Iniciativas
				<span v-if="viewButtonIndex.iniciativa == 'add'">			
					<button class="btn btn-sm btn-primary" @click="clickAdd">Agregar</button>
				</span>
				<span v-if="viewButtonIndex.iniciativa == 'saveAdd' || viewButtonIndex.iniciativa == 'saveModify'">			
					<button class="btn btn-sm btn-primary" @click="clickSave">Grabar</button>
					<button class="btn btn-sm btn-success" @click="clickCancel">Cancelar</button>
				</span>
				<span v-if="viewButtonIndex.iniciativa == 'modify'">
					<button class="btn btn-sm btn-success" @click="clickModify">Modificar</button>
					<button class="btn btn-sm btn-danger" @click="clickDelete">Eliminar</button>
				</span>
			</div>
			<div class="row">
				<select id="sel_iniciativa" v-model="opcion" class="form-control" v-on:change="selectOption(opcion.id)">
		      	<option v-for="item in _iniciativas" :value="item">
		        	{{ item.winiciativa }}
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
				iniciativa: state => state.index.iniciativa,
				viewButtonIndex: state => state.index.viewButtonIndex,
			}),
			...mapGetters({
				_iniciativas: '_iniciativas', 
			}),

		},
		methods: {
			selectOption: function (id) {
				this.$store.dispatch('SelectIniciativa', this.opcion);
				this.$store.commit('iniciativa_id', id);

				this.$store.dispatch('SetStatus', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'iniciativa', status: 'none'});
				
				this.$store.dispatch('SetViewButtonIndex', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'iniciativa', status: 'modify'});

			},
			clickAdd: function () {

				this.$store.dispatch('SetStatus', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'iniciativa', status: 'add'});
				
				this.$store.dispatch('SetViewButtonIndex', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'iniciativa', status: 'saveAdd'});

			},
			clickModify: function () {
				this.$store.dispatch('SetStatus', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'iniciativa', status: 'modify'});
				
				this.$store.dispatch('SetViewButtonIndex', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'iniciativa', status: 'saveModify'});

			},
			clickCancel: function () {
				this.$store.dispatch('SetStatus', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'iniciativa', status: 'none'});
				
				this.$store.dispatch('SetViewButtonIndex', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'iniciativa', status: 'add'});
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
