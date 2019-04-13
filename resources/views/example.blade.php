@extends('layouts.app')

@section('title','Example')

@section('content')
	<div class="container">
			<div class="row">		
				<div class="col-md-2 col-md-offset-1" >
						PERSPECTIVA 1
				</div>
				<div class="col-md-3">
					<example-component :fill_grade=45 title="objetivo1" color="red"></example-component>
				</div>
				<div class="col-md-3">
					<example-component :fill_grade=90 title="objetivo2" color="yellow"></example-component>
				</div>
			</div>
			<div class="row">		
				<div class="col-md-2 col-md-offset-1" >
						PERSPECTIVA 2
				</div>
				<div class="col-md-3">
					<example-component :fill_grade=135 title="objetivo3" color="lime"></example-component>
				</div>
				<div class="col-md-3">
					<example-component :fill_grade=180 title="objetivo4" color="lime"></example-component>
				</div>
			</div>
			<div class="row">		
				<div class="col-md-2 col-md-offset-1" >
						PERSPECTIVA 3
				</div>
				<div class="col-md-3">
					<example-component :fill_grade=225 title="objetivo5" color="lime"></example-component>
				</div>
				<div class="col-md-3">
					<example-component :fill_grade=270 title="objetivo6" color="lime"></example-component>
				</div>
			</div>
		</div>
@endsection

@section('style')
<style>
	.vertical-text {
		vertical-align: middle;
		/*writing-mode: vertical-rl;*/
		/*text-orientation: upright;*/
		/*transform: rotate(90deg);*/
		/*transform-origin: left top 0;*/
	}
</style>
@endsection

@section('view','example.blade.php')