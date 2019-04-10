@extends('layouts.mail')

@section('content')
<table class="content">
	<tbody>	
		<tr>
			<td class="header"><p>BSC-Sys</p></td>
			<td class="header"><p>Acceso a módulo de avances.</p></td>
		</tr>
		<br>
		<tr>
			<td class="body">
				<table class="inner-body" width="70%">
					<tbody>
						<p>Estimado docente: {{ $datos['name'] }}</p>
						<p>Hemos activado su acceso al módulo de avances del mes {{ $datos['wmes'] }}.</p>
						<br>
						<p>Página web: <a class="dato" href="{{ url('/') }}">{{ url('/') }}</a></p>
						<br>
						<p>Usuario: <span class="dato">{{ $datos['email'] }}</span></p>
						<p>Password: <span class="dato">el número de su DNI</span></p>
						<br>
						<p>Su acceso estará disponible hasta el: <span class="dato">{{ $datos['limite'] }}</span> </p>
						<br>
						<p>Por favor ingrese la información del avance de la iniciativa: {{ $datos['winiciativa'] }} y al finalizar publíquela.</p>
						<br>
						<p>Saludos,</p>
						<p>Departamento Académico de la FCEC</p>
						<p><img class="navbar-brand" src="{{asset('images/logo-ucss.png')}}" ></img></p>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>

@endsection

@section('style')
	<style>
		tbody{
			align-content: center;
			width: 70%;
			background:#CCFFFF;
		}
		.header {
			font-family: Avenir, Helvetica, sans-serif; 
			box-sizing: border-box; 
			padding: 25px 0; 
			text-align: center;
			color: #0000FF; font-size: 19px; 
			font-weight: bold; 
			text-decoration: none; 
			text-shadow: 0 1px 0 white;
		}
		.dato{
			color: #ff0000
		}
		p{
			color: #0000FF;
		}
	</style>
@endsection