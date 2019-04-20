<?php

namespace App\Http\Controllers\Api;

use App\Avance;
use App\Http\Controllers\Controller;
use App\Iniciativa;
use App\Objetivo;
use App\Perspectiva;
use App\Programacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PanelController extends Controller
{

  public function getData()
  {
  	$perspectivas = Perspectiva::all();
  	$data = [];
  	foreach ($perspectivas as $key => $perspectiva) {
  		$data1 = [
  			'id' => $perspectiva->id,
  			'wperspectiva' => $perspectiva->wperspectiva,
  			'programado' => $perspectiva->programado(),
  			'avance' => $perspectiva->avance()
  		];
  		$data[$key] = $data1;
  		$objetivos = Objetivo::where('perspectiva_id', $perspectiva->id)->get();
  		$data_obj = [];
  		foreach ($objetivos as $key2 => $objetivo) {
  			$data2 = [
  				'id' => $objetivo->id,
  				'wobjetivo' => $objetivo->wobjetivo,
	  			'programado' => $objetivo->programado(),
	  			'avance' => $objetivo->avance()  				
  			];
  			$data_obj[$key2] = $data2;
  		}
  		$data[$key]['objetivos'] = $data_obj;
  	}
    return [
            'success'=>true,
            'data' => $data
        ];         
  }

}
