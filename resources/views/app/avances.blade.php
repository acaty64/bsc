@extends('layouts.app')

@section('title','Avances')

@section('content')
	<avances-component :iniciativa_id=1 :user_id=1></avances-component>
@endsection

@section('view','avances.blade.php')