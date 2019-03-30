<?php

namespace App;

use App\Iniciativa;
use Illuminate\Database\Eloquent\Model;

class Programacion extends Model
{
    protected $table = 'programaciones';	
    protected $fillable = [	
    	'programado',
    	'mes',
    	'iniciativa_id'
    ];

    public function getIniciativa()
    {
    	return Iniciativa::findOrFail($this->iniciativa_id);
    }
}
