<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">    
        <div class="panel panel-default">
          <div class="panel-heading">INICIATIVA: {{ iniciativa.winiciativa }}</div>
          
          <div class="container">
            <div class="col-md-7 box">
              <div class="panel-body">
                <div>Programado en el mes: {{ mes.programado.toFixed(2) }} {{ iniciativa.indicador }}</div>

                <div>Ejecutado en el mes: {{ mes.ejecutado }} {{ iniciativa.indicador }} 
                </div>

                <span v-if="add && swButton == 'add'">
                  <button class="btn btn-success btn-sm" @click="clickModify">Agregar</button>
                </span>
                <span v-if="swButton == 'modify'">
                  <div>
                    Evidencia: {{ avanceMes.warchivo }}
                  </div>           
                  <button class="btn btn-primary btn-sm" @click="clickModify">Modificar</button>
                </span>
                <span v-if="swButton == 'viewModify'">
                  <avance_board></avance_board>
                </span>

              </div>
            </div>
          </div>
          
          <div class="panel-body">
            <drawComponent></drawComponent>

            <div class="grid">
                <div class="grid-item g1">INICIATIVA: {{ iniciativa.winiciativa }}</div>
                <div class="grid-item g2">Inductor: {{ iniciativa.inductor }}</div>
                <div class="grid-item g3">Meta: {{ iniciativa.meta }}</div>
                <div class="grid-item g4">Indicador: {{ iniciativa.indicador }}</div>
                <div class="grid-item g5">                
                    <semaforoComponent :color="colorIniciativa"></semaforoComponent>
                </div>
            </div>
            <div class="grid">
                <div class="grid-item g1">OBJETIVO ESTRATÉGICO: {{ objetivo.wobjetivo }}</div>
                <div class="grid-item g2">Programado: {{ programado.objetivo }}%</div>
                <div class="grid-item g3">Avance: {{ ejecutado.objetivo }}%</div>
                <div class="grid-item g5">                
                    <semaforoComponent :color="colorObjetivo"></semaforoComponent>
                </div>
            </div>
            <div class="grid">
                <div class="grid-item g1">PERSPECTIVA: {{ perspectiva.wperspectiva }}</div>
                <div class="grid-item g2">Programado: {{ programado.perspectiva }}%</div>
                <div class="grid-item g3">Avance: {{ ejecutado.perspectiva }}%</div>
                <div class="grid-item g5">                
                    <semaforoComponent :color="colorPerspectiva"></semaforoComponent>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import semaforoComponent from './Semaforo.vue'; 
  import avance_board from './AvanceBoard';
  import drawComponent from './Draw';
  import { mapState } from 'vuex';
  import axios from 'axios'
  export default {
    created() {
      console.log('Avances Component mounted.');
      this.setData();
      this.getData();
    },
    props: ['user_id', 'iniciativa_id'],
    computed: {
      ...mapState([
            'avances',
            'programacion',
            'iniciativa',
            'objetivo',
            'perspectiva',
            'programado',
            'ejecutado',
            'avanceMes',
            'linea',
            'circulo1',
            'circulo2',
            'text1',
            'text2',
            'ini',
            'largo',
            'radio',
            'mes',
            'now',
            'swButton',
            'add'
          ]),
      colorIniciativa() { return this.$store.getters.colorIniciativa},
      colorObjetivo() { return this.$store.getters.colorObjetivo},
      colorPerspectiva() { return this.$store.getters.colorPerspectiva},      
    },
    data() {
      return {
      }
    },
    components: {
      semaforoComponent, avance_board, drawComponent
    },
    methods: {
      clickModify: function(){
        this.$store.commit('swButton', 'viewModify');
      },
      setData() {
        this.$store.commit('user_id', this.user_id);
        this.$store.commit('iniciativa_id', this.iniciativa_id);
      },
      getData(){
        this.$store.dispatch('GetData', this.iniciativa_id);
      },
    },
  };
</script>
<style>
  .panel-heading {
    text-align: center;
    font-size: 120%;
  }
  .box {
    border: 1px solid #000;
    border-radius: 25px;
  }
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
    border-radius: 25px;
    padding: 20px;
    margin-bottom: 5px;
  }
  .grid-vertical {
    grid-template-columns: 50%;
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