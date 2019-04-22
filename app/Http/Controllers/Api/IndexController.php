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

class IndexController extends Controller
{

  public function getDataIndex()
  {
  	$perspectivas = Perspectiva::all();
    $objetivos = Objetivo::all();
    $iniciativas = Iniciativa::all();
    $programacion = Programacion::all();

  	$data = [
      'perspectivas' => $perspectivas,
      'objetivos' => $objetivos,
      'iniciativas' => $iniciativas,
      'programacion' => $programacion,
    ];

    return [
            'success'=>true,
            'data' => $data
        ];         
  }

}
