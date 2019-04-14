<template>
  <div class="container">
      <div class="col-md-7">
        <div class="panel panel-default">
          <div class="panel-body">
            <svg height="80" width="600">
                <line :x1="linea.x1" :y1="linea.y1" :x2="linea.x2" :y2="linea.y2" style="stroke:rgb(255,0,0);stroke-width:3" />
                <circle :cx="circulo1.x" :cy="circulo1.y" :r="circulo1.r" :fill="circulo1.color"/>
                <text :x="text1.x" :y="text1.y" :fill="text1.color">{{ programado.iniciativa }}%</text>
                <circle :cx="circulo2.x" :cy="circulo2.y" :r="circulo2.r" :fill="circulo2.color"/>
                <text :x="text2.x" :y="text2.y" :fill="text2.color">{{ ejecutado.iniciativa }}%</text>          
                <text x="5" :y="text1.y" fill="black">Programado</text>          
                <text x="5" :y="text2.y" fill="black">Ejecutado</text>          
            </svg>
            <br>
          </div>
        </div>
      </div>
  </div>
</template>

<script>
  import {mapState} from 'vuex';
  export default {
    created() {
        console.log('Draw Component mounted.');
    },
    data() {
      return {
        circuloDefault: {x:0, y:0, r:0, color:'none'},
        ini: 80,
        largo: 500,
        radio: 20,
      };
    },
    computed: {
      ...mapState({
            programado: state => state.avances.programado, 
            ejecutado: state => state.avances.ejecutado
          }),
      colorIniciativa() { return this.$store.getters.colorIniciativa },
      linea() { 
        return {
          x1: this.ini, 
          x2: this.ini + this.largo,
          y1: this.radio*2, 
          y2: this.radio*2
        }
      },
      circulo1(){
        if(this.isEmpty(this.programado)){
          return this.circuloDefault;
        } 
        return { 
          x: (this.programado.iniciativa/100*this.largo)+this.ini, 
          y: this.linea.y1 - (this.radio), 
          r: this.radio, 
          color:'blue'
        }
      },
      circulo2() { 
        if(this.isEmpty(this.ejecutado)){
          return this.circuloDefault;
        }
        return {
          x: (this.ejecutado.iniciativa/100*this.largo)+this.ini, 
          y: this.linea.y1 + (this.radio), 
          r: this.radio, 
          color: this.colorIniciativa
        }
      },
      text1() {
        return {
          x: this.circulo1.x - 20, 
          y: this.circulo1.y, 
          color:'white'
        }
      },
      text2() {
        return {
          x: this.circulo2.x - 20, 
          y: this.circulo2.y, 
          color:'black'
        }
      },
    },

    methods:{
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
