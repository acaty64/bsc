<template>
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Agregar avance del mes</div>
        <div class="panel-body">
          <div class="row">
            Ingrese avance del mes: <input type="text" :value="valInput"> {{ iniciativa.indicador }}
          </div>
          <div v-if="viewInput">
            <div class="row">
              Seleccione archivo pdf de evidencias: <input type="file" @change="processFile($event)">
            </div> 
          </div>
          <div v-else>
            <div class="row">
              Archivo: {{ avance.warchivo }} <button class="btn btn-danger btn-sm">Reemplazar</button>
            </div>
          </div>
          <div v-if="save">
            <button class="btn btn-primary btn-sm">Grabar</button>
            <button class="btn btn-success btn-sm">Descartar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    mounted() {
      console.log('AvanceBoard Component mounted.');
      this.getData();
    },
    // created() {
    //   this.valInput = this.avance.ejecutado;
    //   console.log('this.avance: ', this.avance);
    //   console.log('this.valInput: ', this.valInput);
    // },
    props: ['mes', 'user_id','iniciativa', 'avance'],
    data() {
      return {
        viewInput: false,
        save: false,
        valInput: 0,
      }; 
    },
    watch: {
      valInput() {
console.log('watch.valInput: ', this.valInput);
        this.$emit('valUpdated', this.valInput);
      },
      avance(){
        this.getData()
      },
    },    
    methods: {
      getData: function () {
        if(!this.isEmpty(this.avance)){            
          this.viewInput = (this.avance.archivo.length>0) ? false : true;
      console.log('this.avance: ', this.avance);
      console.log('this.avance.ejecutado: ', this.avance.ejecutado);
          this.valInput = this.avance.ejecutado;
      console.log('this.valInput: ', this.valInput);
        }
      },
//       processFile(event): {
//         this.avance.archivo = event.target.files[0];
// console.log(this.avance.archivo);
//       },
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

</script>