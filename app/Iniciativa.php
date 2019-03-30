<?php

namespace App;

use App\Avance;
use App\Iniciativa;
use App\Objetivo;
use App\Programacion;
use Illuminate\Database\Eloquent\Model;

class Iniciativa extends Model
{
    protected $table = 'iniciativas';	
    protected $fillable = [	
    	'winiciativa',
    	'inductor',
    	'indicador',
    	'meta',
    	'incidencia',
    	'objetivo_id'
    ];

    public function getObjetivo()
    {
        return Objetivo::findOrFail($this->objetivo_id);
    }

    public function getIniciativasObjetivo()
    {
    	return Iniciativa::where('objetivo_id', $this->objetivo_id)->get();
    }

    public function avance()
    {
        $avances = Avance::where('iniciativa_id', $this->id)->get();
        $nAvance = 0;
        foreach ($avances as $avance) {
            $nAvance = $nAvance + (($avance->ejecutado / $this->meta) * 100);
        }
        return $nAvance;
    }

    public function programado()
    {
        $programado = Programacion::where('iniciativa_id', $this->id)->where('mes', '<=', date("m"))->get();
        $nProgramado = 0;
        foreach ($programado as $programa) {
            $nProgramado = $nProgramado + (($programa->programado / $this->meta) * 100);
        }
        return $nProgramado;
    }


}
