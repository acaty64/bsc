<?php

namespace App;

use App\Iniciativa;
use Illuminate\Database\Eloquent\Model;

class Avance extends Model
{
    protected $table = 'avances';	
    protected $fillable = [
    	'user_id',
    	'iniciativa_id',
    	'ejecutado',
    	'mes',
    	'warchivo',
        'archivo'
    ];

    public function getIniciativa()
    {
    	return Iniciativa::findOrFail($this->iniciativa_id);
    }

    public function getObjetivo()
    {
    	$iniciativa = Iniciativa::findOrFail($this->iniciativa_id);
    	return $iniciativa->getObjetivo();
    }
}
