@extends('layouts.app')

@section('title','Example')

@section('content')
	<example-component :fill_grade=45></example-component>
	<example-component :fill_grade=90></example-component>
	<example-component :fill_grade=180></example-component>
@endsection

@section('view','example.blade.php')