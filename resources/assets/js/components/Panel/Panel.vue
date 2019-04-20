<template>
  <div class="container">
    <span v-for="item in items">
      <div class="row">
        <div class="col-md-2 col-md-offset-1" >
          <circulo :fillGrade="item.avance" :fillRed="item.programado" :title="item.wperspectiva" :colorPoints="getColor(item.avance, item.programado)" type="perspectiva"></circulo>
        </div>
        <span v-for="objetivo in item.objetivos">
          <div class="col-md-3" >
            <circulo :fillGrade="objetivo.avance" :fillRed="objetivo.programado" :title="objetivo.wobjetivo" :colorPoints="getColor(objetivo.avance, objetivo.programado)" type="objetivo"></circulo>
          </div>
        </span>
      </div>
    </span>
  </div>
</template>

<script>
  import circulo from './Circulo.vue'; 
  import { mapState, mapGetters } from 'vuex';

  export default {
    mounted() {
        console.log('Panel Component mounted.');
        this.getData();
    },
    components: {
      circulo
    },
    data() {
      return {

      }
    },

    computed: {
      ...mapState({
        items: state => state.panel.items,
      }),
    },
    
    methods: {
      getColor: function (ejec, prog) {
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
        this.$store.dispatch('GetDataPanel');
      }
    },
       
  };
</script>
