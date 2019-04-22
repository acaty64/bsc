<template>
	<div class="container">
		<div class="col-md-3">
			<div class="row">Perspectivas
				<span v-if="viewButtonIndex.perspectiva == 'add'">			
					<button class="btn btn-sm btn-primary" @click="clickAdd">Agregar</button>
				</span>
				<span v-if="viewButtonIndex.perspectiva == 'saveAdd' || viewButtonIndex.perspectiva == 'saveModify'">			
					<button class="btn btn-sm btn-primary" @click="clickSave">Grabar</button>
					<button class="btn btn-sm btn-success" @click="clickCancel">Cancelar</button>
				</span>
				<span v-if="viewButtonIndex.perspectiva == 'modify'">
					<button class="btn btn-sm btn-success" @click="clickModify">Modificar</button>
					<button class="btn btn-sm btn-danger" @click="clickDelete">Eliminar</button>
				</span>
			</div>
  		<div class="row">  	
				<select id="sel_perspectiva" v-model="opcion" class="form-control" v-on:change="selectOption(opcion.id)">
      		<option v-for="item in perspectivas" :value="item">
        {{ item.wperspectiva }}
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
				perspectiva: state => state.index.perspectiva,
				perspectivas: state => state.index.perspectivas,
				viewButtonIndex: state => state.index.viewButtonIndex,
			}),

		},
		methods: {
			selectOption: function (id) {
				this.$store.dispatch('SelectPerspectiva', this.opcion);
				this.$store.dispatch('SelectObjetivo', {});
				this.$store.dispatch('SelectIniciativa', {});
				this.$store.commit('perspectiva_id', id);
				this.$store.commit('objetivo_id', 0);
				this.$store.commit('iniciativa_id', 0);

				this.$store.dispatch('SetStatus', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'iniciativa', status: 'none'});
				
				this.$store.dispatch('SetViewButtonIndex', {type: 'perspectiva', status: 'modify'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'objetivo', status: 'add'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'iniciativa', status: 'none'});
			},
			clickAdd: function () {
				this.$store.dispatch('SetStatus', {type: 'perspectiva', status: 'add'});
				this.$store.dispatch('SetStatus', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'iniciativa', status: 'none'});
				
				this.$store.dispatch('SetViewButtonIndex', {type: 'perspectiva', status: 'saveAdd'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'iniciativa', status: 'none'});

			},
			clickModify: function () {

				this.$store.dispatch('SetStatus', {type: 'perspectiva', status: 'modify'});
				this.$store.dispatch('SetStatus', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'iniciativa', status: 'none'});
				
				this.$store.dispatch('SetViewButtonIndex', {type: 'perspectiva', status: 'saveModify'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'iniciativa', status: 'none'});

			},
			clickCancel: function () {

				this.$store.dispatch('SetStatus', {type: 'perspectiva', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'objetivo', status: 'none'});
				this.$store.dispatch('SetStatus', {type: 'iniciativa', status: 'none'});
				
				this.$store.dispatch('SetViewButtonIndex', {type: 'perspectiva', status: 'add'});
				this.$store.dispatch('SetViewButtonIndex', {type: 'objetivo', status: 'none'});
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