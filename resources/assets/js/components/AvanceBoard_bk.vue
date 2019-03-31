<template>
  <div class="row">
    <div class="col-md-12 box">
      <div class="panel-body">
        <div class="panel-heading">Agregar/Modificar avance del mes de <b>{{ wmes[now-1] }}</b> 
        <span v-if="viewBtnSave">
          <button class="btn btn-primary btn-sm" @click="clickSave">Grabar</button>
        </span> 
        <button class="btn btn-success btn-sm" @click="clickEscape">Descartar</button>
        </div>
        <div class="panel-body">
          <div class="row">
            Ingrese avance del mes: 
            <input type="text" v-model="valInput" > {{ iniciativa.indicador }}
          </div>
          <br>
          <div v-if="viewInput">
            <div class="row">
              <label for="inputFile">Seleccione archivo pdf de evidencias:</label> 
              <input id="inputFile" type="file" @change="processFile($event)" accept="application/pdf">
            </div> 
          </div>
          <div v-else>
            <div class="row">
              Archivo: 
              <b>{{ avanceMes.warchivo }}</b>
              <button class="btn btn-danger btn-sm" @click="btnViewReplaceFile">{{ labelBtnReplaceFile }}</button>
              <span v-if="viewReplaceFile">
                <div>
                  <label for="replaceFile">Seleccione archivo pdf de reemplazo:</label> 
                  <input id="replaceFile" type="file" @change="processFile($event)" accept="application/pdf">                
                </div>
              </span>
            </div>
          </div>
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
          'swButton'
      ]),
      viewBtnSave() {
        if(this.valInput != this.avanceMes.ejecutado){
          return true;
        }
        if(this.nameFile != this.avanceMes.warchivo){
          return true;
        }
        return false;
      },

      labelBtnReplaceFile(){
        return (this.avanceMes.id == 'new') ? "Seleccionar" : "Reemplazar" ;
      },
    },

    data() {
      return {
        viewInput: false,
        valInput: 0,
        viewReplaceFile: false,
        nameFile: '',
        filePDF: [],
      }; 
    },

    watch: {
      valInput: function(newValue, oldValue) {
        this.$store.dispatch('ChangeEjecutado', newValue);
      },
    },   

    methods: {
      btnViewReplaceFile: function() {
        this.nameFile = this.avanceMes.warchivo;
        if(this.labelBtnReplaceFile == "Reemplazar" || this.labelBtnReplaceFile == "Seleccionar"){
          this.labelBtnReplaceFile = "Descartar";
          this.viewReplaceFile = true;
        }else{
          this.labelBtnReplaceFile = "Reemplazar";
          this.viewReplaceFile = false;
        }
      },
      clickSave: function(){
console.log('TODO AvanceBoard.vue methods: clickSave()');
        var request = this.avanceMes;
        request.warchivo = this.nameFile;
console.log('TODO AvanceBoard.vue methods: request.warchivo: ', request.warchivo);
        request.filePDF = this.filePDF;
        request.ejecutado = this.valInput;
        this.$store.dispatch('SaveData', request);
      },
      clickEscape: function(){
// console.log('TODO AvanceBoard.vue methods: clickEscape()');
        this.viewReplaceFile = false;
        this.labelBtnReplaceFile = "Reemplazar";
        this.viewInput = false;
        
        this.getData();
        this.$store.dispatch('ChangeEjecutado', this.avanceMes.ejecutado);
        this.$store.commit('swButton', 'modify');
      },
      getData: function(){
        this.valInput = this.avanceMes.ejecutado;
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

// Consistencia:
// 
//
// Logica:
//  Recibe avanceMes
//  Modifica avanceMes

</script>