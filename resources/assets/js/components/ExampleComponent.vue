<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Example Component</div>

          <div class="panel-body">
            <svg width="200" height="200">
              <polygon :points="points"></polygon>
              <circle cx="100" cy="100" r="80"></circle>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    mounted() {
        console.log('Example Component mounted.');
        this.fetchStats();
    },
    props: ['fill_grade'],
    data() {
      return {
        faces: 360,
        long: 100,
        stats: [],
      }
    },
    computed: {
      // a computed property for the polygon's points
      points: function () {
        var total = this.stats.length;
        return this.stats.map(function (stat, i) {
          var point = valueToPoint(stat.value, i, total);
          return point.x + ',' + point.y;
        }).join(' ');
      },
    },
    methods: {
      fetchStats: function() {
        this.stats = [];
        for (var i = 0; i < this.faces; i++) {
          if(i > this.fill_grade){
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
    },
       
  };


// math helper...
function valueToPoint (value, index, total) {
  var x     = 0
  var y     = -value * 0.8
  var angle = Math.PI * 2 / total * index
  var cos   = Math.cos(angle)
  var sin   = Math.sin(angle)
  var tx    = x * cos - y * sin + 100
  var ty    = x * sin + y * cos + 100
  return {
    x: tx,
    y: ty
  }
}

</script>
<style>
  body {
      font-family: Helvetica Neue, Arial, sans-serif;
  }

  polygon {
      fill: #42b983;
      opacity: .75;
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