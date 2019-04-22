<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">    
        <div class="panel panel-default">
          <div class="panel-heading">INICIATIVA: {{ iniciativa.winiciativa }}
            <br>{{ subtitle }}
          </div>
          <div class="container">
            <div class="col-md-7 box">
              <div class="panel-body">
                Status: {{ wstatus }}
                <span v-if="status != 'add' && status != 'viewModify' && avanceMes.warchivo != ''">
                  <button class="btn btn-primary btn-sm" @click="clickView">Ver Archivo</button>
                </span>
                <span v-if="status == 'checked'">
                  <button class="btn btn-primary btn-sm" @click="clickChecked">Aprobado</button>
                  <button class="btn btn-primary btn-sm" @click="clickUnchecked">Observado</button>
                </span>
                <span v-if="status == 'modify'">
                  <button class="btn btn-success btn-sm" @click="clickModify">Modificar</button>
                  <button class="btn btn-success btn-sm" @click="clickPublish">Publicar</button>
                </span>

                <br>
                <div>Programado en el mes: {{ mes.programado.toFixed(2) }} {{ iniciativa.indicador }}</div>

                <div>Ejecutado en el mes: {{ mes.ejecutado }} {{ iniciativa.indicador }} 
                </div>

                <span v-if="status == 'add'">
                  <button class="btn btn-success btn-sm" @click="clickModify">Agregar</button>
                </span>
                <span v-else>                  
                  <div>
                    Evidencia: {{ avanceMes.warchivo }}
                  </div>
                </span>

                <span v-if="status == 'viewModify'">
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
  import { mapState, mapGetters } from 'vuex';
  import axios from 'axios'
  export default {
    created() {
      console.log('Avances Component mounted.');
console.log('avances props: ', [this.user_id, this.iniciativa_id_, this.mm, this.yyyy]);
      this.setData();
      this.getData();
    },
    props: ['user_id', 'iniciativa_id_', 'mm', 'yyyy'],
    computed: {
      ...mapState({
          status: state => state.avances.status,
          avances: state => state.avances.avances,
          programacion: state => state.avances.programacion,
          iniciativa: state => state.avances.iniciativa,
          objetivo: state => state.avances.objetivo,
          perspectiva: state => state.avances.perspectiva,
          programado: state => state.avances.programado,
          ejecutado: state => state.avances.ejecutado,
          avanceMes: state => state.avances.avanceMes,
          linea: state => state.avances.linea,
          circulo1: state => state.avances.circulo1,
          circulo2: state => state.avances.circulo2,
          text1: state => state.avances.text1,
          text2: state => state.avances.text2,
          ini: state => state.avances.ini,
          largo: state => state.avances.largo,
          radio: state => state.avances.radio,
          mes: state => state.avances.mes,
          now: state => state.avances.now,
          year: state => state.avances.year,
          wmessage1: state => state.avances.wmessage1,
          wmessage2: state => state.avances.wmessage2,
        }),
      ...mapGetters({
            // now: 'now',
            // year: 'year',
            colorIniciativa: 'colorIniciativa', 
            colorObjetivo: 'colorObjetivo', 
            colorPerspectiva: 'colorPerspectiva',
            wmes: 'wmes',
          }),
      subtitle(){
        return "Mes: "+this.wmes+" Año: "+this.year;
      },
      wstatus(){
        switch(this.status) {
          case 'view': return "VISUALIZACIÓN "+this.wmessage1+"-"+this.wmessage2; break;
          case 'add': return "AGREGAR"; break;
          case 'modify': return "EDITAR "+this.wmessage1; break;
          case 'viewModify': return "MODIFICACIÓN DE AVANCE"; break;
          case 'published': return "PUBLICADO "+this.wmessage2; break;
          case 'checked': return "VERIFICACIÓN "+this.wmessage2; break;
          case 'complete': return "COMPLETO "+this.wmessage1+"-"+this.wmessage2; break;
        }
      }      
    },
    components: {
      semaforoComponent, avance_board, drawComponent
    },
    watch: {
      mm: function () {
        this.$store.commit('now', this.mm);
        this.getData();
      },
      yyyy: function () {
        this.$store.commit('year', this.yyyy);
        this.getData();
      },
      iniciativa_id_: function () {
        this.getData();
      },
    },
    methods: {
      clickChecked: function () {
        // TODO: store.js action 
        // this.$store.dispatch('ClickButton', 'checked');
        // this.$store.commit('checked', true);
      },
      clickUnchecked: function () {
        // TODO: store.js action 
        // this.$store.dispatch('ClickButton', 'unchecked');
        // this.$store.commit('checked', false);
      },
      clickView: function () {
        var filepath = this.avanceMes.archivo;
        var filenameWithExtension = filepath.replace(/^.*[\\\/]/, '');
        var filename = 'storage/avances/'+filenameWithExtension;
        window.open(filename, '_blank');
      },
      clickPublish: function () {
        this.$store.dispatch('ClickButton', 'published');
        this.$store.dispatch('SavePublished', this.avanceMes.id);
        this.$store.commit('published', true);
      },
      clickModify: function(){
        this.$store.dispatch('ClickButton', 'viewModify');
      },
      async setData() {
console.log('setData datos: ', [this.user_id, this.iniciativa_id_, this.mm, this.yyyy]);
        await this.$store.commit('user_id', this.user_id);
        await this.$store.commit('iniciativaid', this.iniciativa_id_);
        await this.$store.commit('now', this.mm);
        await this.$store.commit('year', this.yyyy);
      },
      async getData(){
console.log('getData datos: ', [this.iniciativa_id_, this.mm, this.yyyy]);
        await this.$store.dispatch('GetData', [this.iniciativa_id_, this.mm, this.yyyy]);
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