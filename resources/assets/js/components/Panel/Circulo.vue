<template>
  <div class="float-left">
    <div class="panel panel-default objetivo">
      <div class="panel-heading"><b>{{ type }}: </b> {{ title }}</div>
      <div class="panel-body" :style="cuadro">
        <svg :width="svg_width" :height="svg_height">
          <polygon :points="pointsRed" fill="red"></polygon>
          <polygon :points="points" :fill="colorPoints"></polygon>
          <circle :cx="cx" :cy="cy" :r="r"></circle>
        </svg>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    mounted() {
        console.log('Objetivo Component mounted.');
        this.fetchRed();
        this.fetchStats();
    },
    props: ['fillGrade', 'fillRed', 'title', 'colorPoints', 'type'],
    data() {
      return {
        faces: 180,
        long: 80,
        stats: [],
        statsRed: [],
      }
    },
    computed: {
      svg_width: function(){ return this.long*2 },
      svg_height: function(){ return this.long*2 },
      cx: function(){ return this.long },
      cy: function(){ return this.long },
      r: function(){ return this.long*0.8 },
      // a computed property for the polygon's points
      points: function () {
        var total = this.stats.length;
        var center = this.long;
        return this.stats.map(function (stat, i) {
          var point = valueToPoint(stat.value, i, total, center);
          return point.x + ',' + point.y;
        }).join(' ');
      },
      pointsRed: function () {
        var total = this.statsRed.length;
        var center = this.long;
        return this.statsRed.map(function (stat, i) {
          var point = valueToPoint(stat.value, i, total, center);
          return point.x + ',' + point.y;
        }).join(' ');
      },
      cuadro: function () {
        if(this.type == 'perspectiva'){
          var padding = '0px';
        }else{
          var padding = '40px';
        }
        return "padding-left: "+padding;
      }
    },
    methods: {
      fetchStats: function() {
        var fill_faces = this.fillGrade/360*this.faces;
        this.stats = [];
        for (var i = 0; i < this.faces; i++) {
          if( i > fill_faces ){
            var largo = 0;
          }else{
            var largo = this.long;
          }
          var array = {
            label: 'p'+i,
            value: largo
          };
          this.stats.push(array);
        }
      }, 
      fetchRed: function() {
        var fill_faces = this.fillRed/360*this.faces;
        this.statsRed = [];
        for (var i = 0; i < this.faces; i++) {
          if( i > fill_faces ){
            var largo = 0;
          }else{
            var largo = this.long;
          }
          var array = {
            label: 'p'+i,
            value: largo
          };
          this.statsRed.push(array);
        }
      }, 
    },
       
  };


// math helper...
function valueToPoint (value, index, total, center) {
  var x     = 0;
  var y     = -value * 0.8;
  var angle = Math.PI * 2 / total * index;
  var cos   = Math.cos(angle);
  var sin   = Math.sin(angle);
  var tx    = x * cos - y * sin + center;
  var ty    = x * sin + y * cos + center;
  return {
    x: tx,
    y: ty
  }
}

</script>
<style>
  .panel-heading {
    text-align: center;
  }

  .cuadro {
    padding-left: 40px;
  }

  .objetivo {
    margin-bottom: 0;
  }

  body {
      font-family: Helvetica Neue, Arial, sans-serif;
  }

  polygon {
      opacity: 1;
  }

  circle {
      fill: transparent;
      stroke: #999;
  }

  text {
      font-family: Helvetica Neue, Arial, sans-serif;
      font-size: 10px;
      fill: #666;
  }

  label {
      display: inline-block;
      margin-left: 10px;
      width: 20px;
  }

  #raw {
      position: absolute;
      top: 0;
      left: 300px;
  } 
</style>