@extends('layouts.app')

@section('title','Avances')

@section('content')
	<avances-component  :user_id=1 :iniciativa_id_=1 :mm=4 :yyyy=2019></avances-component>
@endsection

@section('view','avances.blade.php')