<?php

namespace App;

use App\Objetivo;
use Illuminate\Database\Eloquent\Model;

class Perspectiva extends Model
{
    protected $table = 'perspectivas';	
    protected $fillable = [	
    	'wperspectiva'
    ];

    public function avance($month, $year)
    {
        $objetivos = Objetivo::where('perspectiva_id', $this->id)->get();
        $avance = 0;
        foreach ($objetivos as $objetivo) {
            $avance = $avance + ($objetivo->avance($month, $year)*($objetivo->incidencia/100)); 
        }
        return $avance; 
    }

    public function programado($month, $year)
    {
        $objetivos = Objetivo::where('perspectiva_id', $this->id)->where('year', $year)->get();
        $programado = 0;
        foreach ($objetivos as $objetivo) {
            $programado = $programado + ($objetivo->programado($month, $year)*($objetivo->incidencia/100)); 
        }
        return $programado;	
    }

}
