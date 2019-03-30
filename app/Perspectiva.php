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

    public function avance()
    {
        $objetivos = Objetivo::where('perspectiva_id', $this->id)->get();
        $avance = 0;
        foreach ($objetivos as $objetivo) {
            $avance = $avance + ($objetivo->avance()*($objetivo->incidencia/100)); 
        }
        return $avance; 
    }

    public function programado()
    {
        $objetivos = Objetivo::where('perspectiva_id', $this->id)->get();
        $programado = 0;
        foreach ($objetivos as $objetivo) {
            $programado = $programado + ($objetivo->programado()*($objetivo->incidencia/100)); 
        }
        return $programado;	
    }

}
