<?php

namespace App;

use App\Iniciativa;
use App\Objetivo;
use App\Perspectiva;
use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $table = 'objetivos';	
    protected $fillable = [	
    	'wobjetivo',
    	'perspectiva_id',
        'year',
    	'incidencia'
    ];

    public function getPerspectiva()
    {
        return Perspectiva::findOrFail($this->perspectiva_id);
    }

    public function getObjetivosPerspectiva()
    {
        return Objetivo::where('perspectiva_id', $this->perspectiva_id)->get();
    }

    public function avance($month, $year)
    {
        $iniciativas = Iniciativa::where('objetivo_id', $this->id)->where('year',$year)->get();
        $avance = 0;
        foreach ($iniciativas as $iniciativa) {
            $avance = $avance + ($iniciativa->avance($month, $year)*($iniciativa->incidencia/100)); 
        }
        return $avance;
    }

    public function programado($month, $year)
    {
        $iniciativas = Iniciativa::where('objetivo_id', $this->id)->where('year', $year)->get();
        $programado = 0;
        foreach ($iniciativas as $iniciativa) {
            $programado = $programado + ($iniciativa->programado($month, $year)*($iniciativa->incidencia/100)); 
        }
        return $programado;
    }

}
