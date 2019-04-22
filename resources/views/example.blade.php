@extends('layouts.app')

@section('title','Example')

@section('content')
	<index-component :iniciativa_id_=1 :user_id=1 :mm=3 :yyyy=2019></index-component>
@endsection

@section('style')
<style>

</style>
@endsection

@section('view','example.blade.php')