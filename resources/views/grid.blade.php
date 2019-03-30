@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <svg height="80" width="800">
      <polygon points="100,25 90,15 110,15" style="fill:lime;stroke:purple;stroke-width:1" />
      <circle cx="50" cy="20" r="20" fill="red"/>
      <text x="40" y="20" fill="white">100%</text>
      <line x1="20" y1="40" x2="620" y2="40" style="stroke:rgb(255,0,0);stroke-width:3" />
      <circle cx="150" cy="60" r="20" fill="yellow"/>
      <text x="140" y="60" fill="black">100%</text>
      <polygon points="200,25 190,35 210,35" style="fill:lime;stroke:purple;stroke-width:1" />
    </svg>      
  </div>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">GRILLA</div>
        {{-- ********************* --}}
        <div class="panel-body">
          <div class="row">
            <div class="grid">
              <div class="grid-item g1">1</div>
              <div class="grid-item g2">2</div>
              <div class="grid-item g3">3</div>
              <div class="grid-item g4">4</div>
            </div>

            <div class="grid grid-vertical">
              <div class="grid-item g1">1</div>
              <div class="grid-item g2">2</div>
              <div class="grid-item g3">3</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('style')
<style>
  .grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-auto-rows: minmax(150px, auto);
    grid-template-areas: 
              "g1 g4"
              "g2 g4"
              "g3 g4"
  }

  .grid-vertical {
    grid-template-columns: 50%;
    grid-template-areas: 
              "g1"
              "g2"
              "g2"
              "g3"
  }

  .grid-item {
    border: 1px solid #000;
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
    grid-area: g4
  }

  
</style>
@endsection
