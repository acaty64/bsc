<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">    
        <div class="panel panel-default">
          <div class="panel-heading">{{ iniciativa.winiciativa }}</div>
          <div class="panel-body">
            <div>Programado en el mes: {{ mes.programado }} {{ iniciativa.indicador }}</div>
            <div>
              <div>
                Ejecutado en el mes: {{ mes.ejecutado }} {{ iniciativa.indicador }} 
              </div>
              <span v-if="swButton == 'add'">
                <button class="btn btn-success btn-sm" @click="clickModify">Agregar</button>
              </span>
              <span v-else>
                <span v-if="swButton == 'modify'">                
                  <div>
                    Evidencia: {{ avanceMes.warchivo }}
                  </div>
                  <button class="btn btn-primary btn-sm" @click="clickModify">Modificar</button>
                  <button class="btn btn-danger btn-sm">Eliminar</button>
                </span>
              </span>
            </div>
            <span v-if="swButton == 'viewModify'">            
              <avance_board-component
                :mes="now"
                :user_id="user_id"
                :iniciativa="iniciativa"
                :avance="avanceMes" 
                @valUpdated="updateValue">
              </avance_board-component>  
            </span>
          </div>
          <div class="panel-body">
            <svg height="80" width="800">
                <line :x1="linea.x1" :y1="linea.y1" :x2="linea.x2" :y2="linea.y2" style="stroke:rgb(255,0,0);stroke-width:3" />
                <circle :cx="circulo1.x" :cy="circulo1.y" :r="circulo1.r" :fill="circulo1.color"/>
                <text :x="text1.x" :y="text1.y" :fill="text1.color">{{ programado.iniciativa }}%</text>
                <circle :cx="circulo2.x" :cy="circulo2.y" :r="circulo2.r" :fill="circulo2.color"/>
                <text :x="text2.x" :y="text2.y" :fill="text2.color">{{ ejecutado.iniciativa }}%</text>          
                <text x="5" :y="text1.y" fill="black">Programado</text>          
                <text x="5" :y="text2.y" fill="black">Ejecutado</text>          
            </svg>
            <br>
            <div class="grid">
                <div class="grid-item g1">INICIATIVA: {{ iniciativa.winiciativa }}</div>
                <div class="grid-item g2">Inductor: {{ iniciativa.inductor }}</div>
                <div class="grid-item g3">Meta: {{ iniciativa.meta }}</div>
                <div class="grid-item g4">Indicador: {{ iniciativa.indicador }}</div>
                <div class="grid-item g5">                
                    <semaforo-component :color="semaforo(ejecutado.iniciativa, programado.iniciativa)"></semaforo-component>
                </div>
            </div>
            <br>
            <div class="grid">
                <div class="grid-item g1">OBJETIVO ESTRATÉGICO: {{ objetivo.wobjetivo }}</div>
                <div class="grid-item g2">Programado: {{ programado.objetivo }}%</div>
                <div class="grid-item g3">Avance: {{ ejecutado.objetivo }}%</div>
                <div class="grid-item g5">                
                    <semaforo-component :color="semaforo(ejecutado.objetivo, programado.objetivo)"></semaforo-component>
                </div>
            </div>
            <br>
            <div class="grid">
                <div class="grid-item g1">PERSPECTIVA: {{ perspectiva.wperspectiva }}</div>
                <div class="grid-item g2">Programado: {{ programado.perspectiva }}%</div>
                <div class="grid-item g3">Avance: {{ ejecutado.perspectiva }}%</div>
                <div class="grid-item g5">                
                    <semaforo-component :color="semaforo(ejecutado.perspectiva, programado.perspectiva)"></semaforo-component>
                </div>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
      created() {
          console.log('Avances Component mounted.');
          this.getData();
      },
      data() {
        return {
          loading: true,
          URLdomain: window.location.host,
          protocol: window.location.protocol,
          avances: [],
          avanceMes: {},
          avanceDefault: {
            user_id: this.user_id,
            iniciativa_id: this.iniciativa_id,
            ejecutado: "",
            mes: new Date().getMonth() + 1,
            warchivo: "",
            archivo: ""
          },
          programacion: [],
          iniciativa: [],
          objetivo: [],
          perspectiva: [],
          documento: "",
          programado: [],
          ejecutado: [],
          linea: {x1:0, x2:0,y1:0, y2:0},
          circulo1: {x:0, y:0, r:0, color:'none'},
          circulo2: {x:0, y:0, r:0, color:'none'},
          text1: {x:0, y:0, color:'none'},
          text2: {x:0, y:0, color:'none'},
          ini: 80,
          largo: 500,
          radio: 20,
          mes: {
              ejecutado: 0,
              programado: 0
            },
          now: new Date().getMonth() + 1,
          swButton: 'add',
        };
      },
      props: ['user_id', 'iniciativa_id'],
      methods:{
        clickModify: function(){
          this.swButton = 'viewModify'; 
        },
        updateValue(value) {
          console.log("Nuevo valor de avance: ", value);
          this.avanceMes.ejecutado = value;
        },
        draw: function () {
            this.linea.x1 = this.ini ;
            this.linea.x2 = this.ini + this.largo;
            this.linea.y1 = this.radio*2;
            this.linea.y2 = this.radio*2;

            this.circulo1.x = (this.programado.iniciativa/100*this.largo)+this.ini;
            this.circulo1.y = this.linea.y1 - (this.radio);
            this.circulo1.r = this.radio;
            this.circulo1.color = "blue";
            
            this.circulo2.x = (this.ejecutado.iniciativa/100*this.largo)+this.ini;
            this.circulo2.y = this.linea.y1 + (this.radio);
            this.circulo2.r = this.radio;
            this.circulo2.color = this.semaforo(this.ejecutado.iniciativa, this.programado.iniciativa);
            
            this.text1.x = this.circulo1.x - 20;
            this.text1.y = this.circulo1.y;
            this.text1.color = "white";
            
            this.text2.x = this.circulo2.x - 20;
            this.text2.y = this.circulo2.y;
            this.text2.color = "black";
        },          
          getMes: function () {
            var ejecutado = 0;
            for (var i = this.avances.length - 1; i >= 0; i--) {
              if(this.avances[i].mes == this.now){
                var ejecutado = this.avances[i].ejecutado;
                this.avanceMes = this.avances[i];
              }
            }
            var programado = 0;
            for (var i = this.programacion.length - 1; i >= 0; i--) {
              if(this.programacion[i].mes == this.now){
                var programado = this.programacion[i].programado;
              }
            }
            this.mes.ejecutado =  ejecutado;
            this.mes.programado =  programado;
          },
          semaforo: function(ejec, prog) {
// console.log("ejec/prog", ejec/prog);
              if(ejec/prog >= 0.95){
                  return 'lime';
              }
              if(ejec/prog >= 0.5 && ejec/prog < 0.95){
                  return 'yellow';
              }
              if(ejec/prog < 0.5){
                  return 'red';
              }
          },
          getData: function () {   
              var request = {
                  'iniciativa_id': this.iniciativa_id,
              };
              var url = this.protocol+'//'+this.URLdomain+'/api/avances/getData';
              axios.post(url, request).then(response=>{
                  this.avances = response.data.data.avances;
                  this.programacion = response.data.data.programacion;
                  this.iniciativa = response.data.data.iniciativa;
                  this.objetivo = response.data.data.objetivo;
                  this.perspectiva = response.data.data.perspectiva;
                  this.programado = response.data.data.programado;
                  this.ejecutado = response.data.data.ejecutado;
                  // this.now = response.data.data.now;
                  this.avanceMes = this.avanceDefault;
console.log('getData.this.avanceMes1: ', this.avanceMes);
                  if(!this.isEmpty(response.data.data.avanceMes)){
                    this.avanceMes = response.data.data.avanceMes;
                    this.swButton = 'modify';
console.log('getData.this.avanceMes2: ', this.avanceMes);
                  }
console.log('getData.this.avanceMes3: ', this.avanceMes);
                  this.draw();
                  this.getMes();
console.log('response.data.data: ', response.data.data);
              }).catch(function (error) {
                  console.log('getData: ',error);
              });
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
<style>
  .grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-auto-rows: minmax(30px, auto);
    grid-template-areas: 
              "g1 g5"
              "g2 g5"
              "g3 g5"
              "g4 g5";
    border: 1px solid #000;
  }

  .grid-vertical {
    grid-template-columns: 50%;
/*    grid-template-areas: 
              "g1"
              "g2"
              "g2"
              "g3"*/
  }

  .grid-item {
    /*border: 1px solid #000;*/
  }

  .g1 {
    grid-area: g1;
  }

  .g2 {
    grid-area: g2
  }

  .g3 {
    grid-area: g3
  }

  .g4 {
    grid-area: g4;
  }

  .g5 {
    grid-area: g5;
  }

  
</style>