<template>
  <!-- form enctype="multipart/form-data" -->
  <div class="row">
    <div class="col-md-12 box">
      <div class="panel-body">
        <div class="panel-heading">
          <div>{{ labelTitle }}
            <button class="btn btn-success btn-sm" v-if="viewBtnSave" @click="clickSave">Grabar</button>
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
              <input id="inputFile" enctype="multipart/form-data" type="file" @change="processFile($event)" accept="application/pdf">
            </div>
          </span>
          <span v-else>
              Archivo: 
              <b>{{ avanceMes.warchivo }}</b> 
              <span v-if="viewBtnBoard2">
                <button class="btn btn-success btn-sm" @click="clickViewBoard2">Modificar Archivo</button>
                <button class="btn btn-primary btn-sm" @click="clickViewPDF">Ver Archivo</button>                
              </span>           
          </span>
          <span v-if="viewBoard2">
            <button class="btn btn-primary btn-sm" @click="restoreBoard2">Descartar</button>
            <div>
              <label for="replaceFile">Seleccione archivo pdf de reemplazo:</label> 
              <input id="replaceFile" type="file" @change="processFile($event)" accept="application/pdf">                
              <button class="btn btn-primary btn-sm" v-if="viewBtnBoard3" @click="clickViewPDF">Ver Archivo</button>                
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
          // 'add',
          'protocol',
          'URLdomain',
          'status',
          'archivoTemp'
      ]),
      add(){
        if(this.status == 'add'){
          return true;
        }
        return false;
      },
      viewBtnBoard3(){
        if(this.viewBoard2 && this.nameFile != this.avanceMes.warchivo){
          return true;
        }
      },
      viewBtnBoard2(){
        if(this.status != 'add' && !this.viewBoard2){
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
        return (this.avanceMes.id == 0) 
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
      clickViewPDF: function () {
        if(this.filePDF.length == 0){
          let filepath = this.avanceMes.archivo;
          let filenameWithExtension = filepath.replace(/^.*[\\\/]/, '');
          let filename = 'storage/avances/'+filenameWithExtension;          
        // }else{
        //   var archivoPDF = this.filePDF.getOriginalName();
        //   window.open(archivoPDF, '_blank', 'fullscreen=yes');
          let url = this.protocol+'//'+this.URLdomain+"/"+filename;
console.log('clickViewPDF 1: ', url);       
          window.open(url, "_blank");
// console.log('clickViewPDF: ', url);
        }else{
console.log('clickViewPDF 2: ', this.archivoTemp);       
          // var archivoPDF = this.filePDF.getOriginalName();
          // window.open(this.filePDF, '_blank');
          window.open(this.archivoTemp, "_blank"); 
          // return false;

        }
        // axios.get(url).then(response=>{

        // }).catch(function (error) {
        //   console.log('clickViewPDF: ',error);
        // });
      },
      clickViewBoard2: function(){
        this.viewBoard2 = true;
      },
      restoreBoard1: function(){
        this.getData();
        this.$store.dispatch('ChangeEjecutado', this.avanceMes.ejecutado);
        this.restoreBoard2();
        this.$store.commit('status', 'modify');
      },
      restoreBoard2: function(){
        this.nameFile = '';
        this.filePDF = '';
        this.viewBoard2 = false;
      },

      clickSave: function(){
        toastr.closeButton = false;
        toastr.debug = false;
        toastr.showDuration = 50;
        let mess = '';
        let consistencia = true;
        if(this.nameFile == ""){
          consistencia = false;
          mess = "Debe seleccionar un archivo con la evidencia de su avance."
        }
        if(this.valInput == 0 ){
          consistencia = false;
          mess = "Debe ingresar el avance del mes."
        }
        if(consistencia){
          let request = this.avanceMes;
          request.warchivo = this.nameFile;
          request.ejecutado = this.valInput;
          request.filePDF = this.filePDF;
          let answer = this.$store.dispatch('SaveData', request);
          this.restoreBoard2();
          this.restoreBoard1();
          toastr.success("Avance grabado.");
        }
        else{
          toastr.error(mess);
        }

      },

      getData: function(){
        this.valInput = this.avanceMes.ejecutado;
        this.nameFile = this.avanceMes.warchivo;
      },
      processFile: function(event) {
console.log('processFile: ', event);
        this.nameFile = event.target.files[0].name;
        this.filePDF = event.target.files[0];
        let request = {};
        request.filePDF = this.filePDF;
        this.$store.dispatch('SaveFileTemp', request);
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