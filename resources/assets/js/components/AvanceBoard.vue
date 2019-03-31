<template>
  <div class="row">
    <div class="col-md-12 box">
      <div class="panel-body">
        <div class="panel-heading">
          <div>{{ labelTitle }}
            <button class="btn btn-primary btn-sm" v-if="viewBtnSave" @click="clickSave">Grabar</button>
            <button class="btn btn-primary btn-sm" @click="restoreBoard1">Descartar</button>
          </div>
        </div>
        <div class="panel-body">
          <div>
            Ingrese avance del mes: 
            <input type="text" v-model="valInput" > {{ iniciativa.indicador }}
          </div>
          <span v-if="add">
            <br>
            <div class="row">
              <label for="inputFile">Seleccione archivo pdf de evidencias:</label> 
              <input id="inputFile" type="file" @change="processFile($event)" accept="application/pdf">
            </div>
          </span>
          <span v-else>
              Archivo: 
              <b>{{ avanceMes.warchivo }}</b>            
              <button class="btn btn-primary btn-sm" v-if="viewBtnBoard2" @click="clickViewBoard2">Modificar Archivo</button>
          </span>
          <span v-if="viewBoard2">
            <button class="btn btn-primary btn-sm" @click="restoreBoard2">Descartar</button>
            <div>
              <label for="replaceFile">Seleccione archivo pdf de reemplazo:</label> 
              <input id="replaceFile" type="file" @change="processFile($event)" accept="application/pdf">                
            </div>
          </span>
        </div>
      </div>  
    </div>
  </div>
</template>
<script>
  import {mapState} from 'vuex';
  export default {
    created() {
      console.log('AvanceBoard Component mounted.');
      this.getData();
    },

    computed: {
      ...mapState([
          'wmes',
          'now',
          'user_id',
          'iniciativa',
          'avanceMes',
          'swButton',
          'add'
      ]),
      viewBtnBoard2(){
        if(!this.add && !this.viewBoard2){
          return true;
        }
      },
      viewBtnSave() {
        if(this.valInput != this.avanceMes.ejecutado){
          return true;
        }
        if(this.nameFile != this.avanceMes.warchivo){
          return true;
        }
        return false;
      },
      labelTitle(){
        return (this.avanceMes.id == 'new') 
          ? "Agregar avance del mes de " + this.wmes[this.now-1] 
          : "Modificar avance del mes de " + this.wmes[this.now-1] ;
      },
    },

    data() {
      return {
        viewInput: false,
        valInput: 0,
        viewReplaceFile: false,
        nameFile: '',
        filePDF: [],
        viewBoard2: false,
      }; 
    },

    watch: {
      valInput: function(newValue, oldValue) {
        this.$store.dispatch('ChangeEjecutado', newValue);
      },
    },   

    methods: {
      clickViewBoard2: function(){
        this.viewBoard2 = true;
      },
      restoreBoard1: function(){
console.log('TODO AvanceBoard.vue methods: restoreBoard1()');
        this.getData();
        this.$store.dispatch('ChangeEjecutado', this.avanceMes.ejecutado);
        this.restoreBoard2();
        this.$store.commit('swButton', 'modify');
      },
      restoreBoard2: function(){
console.log('TODO AvanceBoard.vue methods: restoreBoard2()');
        this.viewBoard2 = false;
      },
      // btnViewReplaceFile: function() {
        // this.nameFile = this.avanceMes.warchivo;
        // if(this.labelBtnReplaceFile == "Reemplazar" || this.labelBtnReplaceFile == "Seleccionar"){
        //   this.labelBtnReplaceFile = "Descartar";
        //   this.viewReplaceFile = true;
        // }else{
        //   this.labelBtnReplaceFile = "Reemplazar";
        //   this.viewReplaceFile = false;
        // }
      // },

      clickSave: function(){
console.log('TODO AvanceBoard.vue methods: clickSave()');
        var request = this.avanceMes;
        request.warchivo = this.nameFile;
console.log('TODO AvanceBoard.vue methods: request.warchivo: ', request.warchivo);
        request.filePDF = this.filePDF;
        request.ejecutado = this.valInput;
        this.$store.dispatch('SaveData', request);
      },

//       clickEscape: function(){
// console.log('TODO AvanceBoard.vue methods: clickEscape()');
        // this.viewReplaceFile = false;
        // this.labelBtnReplaceFile = "Reemplazar";
        // this.viewInput = false;
        
        // this.getData();
        // this.$store.dispatch('ChangeEjecutado', this.avanceMes.ejecutado);
        // this.$store.commit('swButton', 'modify');
      // },
      getData: function(){
        this.valInput = this.avanceMes.ejecutado;
        this.nameFile = this.avanceMes.warchivo;
      },
      processFile: function(event) {
        this.nameFile = event.target.files[0].name;
        this.filePDF = event.target.files[0];
        this.archivo = '';
      },
      isEmpty: function (obj) {
        for (var key in obj) {
          if(obj.hasOwnProperty(key))
            return false;
        }
        return true;
      },
    },
	};	

</script>