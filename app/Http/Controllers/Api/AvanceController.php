<?php

namespace App\Http\Controllers\Api;

use App\Avance;
use App\Http\Controllers\Controller;
use App\Iniciativa;
use App\Programacion;
use Illuminate\Http\Request;

class AvanceController extends Controller
{
    public function getData(Request $request)
    {
        // $avances = Avance::findOrFail($request->id);
        $iniciativa = Iniciativa::findOrFail($request->iniciativa_id);
        $iniciativas = $iniciativa->getIniciativasObjetivo();        
        $objetivo = $iniciativa->getObjetivo();
        $perspectiva = $iniciativa->getObjetivo()->getPerspectiva();
        $avances = Avance::where('iniciativa_id', $iniciativa->id)->get();
        $programacion = Programacion::where('iniciativa_id', $iniciativa->id)->get();

        $ejecutado = [
                'iniciativa' => (empty($iniciativa->avance())) ? 0 : $iniciativa->avance(),
                'objetivo' => (empty($objetivo->avance())) ? 0 : $objetivo->avance(),
                'perspectiva' => (empty($perspectiva->avance())) ? 0 : $perspectiva->avance(),                
            ];

        $programado = [
                'iniciativa' => (empty($iniciativa->programado())) ? 0 : $iniciativa->programado(),
                'objetivo' => (empty($objetivo->programado())) ? 0 : $objetivo->programado(),
                'perspectiva' => (empty($perspectiva->programado())) ? 0 : $perspectiva->programado(),
            ];
        $sw_add = true;
        $avanceMes = [];
        foreach ($avances as $avance) {
            if((int)date("m")==$avance->mes){
                $avanceMes = $avance;
            }
        }
        $data = [
                'perspectiva' => $perspectiva,
                'objetivo' => $objetivo,
                'iniciativa' => $iniciativa,
                'programacion' => $programacion,
                'avances'    => $avances,                
                'ejecutado'    => $ejecutado,                
                'programado' => $programado,
                'now' => (int)date("m"),
                'avanceMes' => $avanceMes,
            ];

        return [
                'success'=>true,
                'data' => $data
            ];         
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $avance = Avance::create([
                'iniciativa_id' => $request->iniciativa_id,
                'user_id' => $request->user_id,
                'ejecutado' => $request->ejecutado,
                'mes' => $request->mes,
                'warchivo' => $request->warchivo,
                'archivo' => $request->archivo
            ]);
        return [
                'success'=>true
            ];    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $avance = Avance::findOrFail($id);
        $avance->user_id = $request->user_id;
        $avance->ejecutado = $request->ejecutado;
        $avance->mes = $request->mes;
        $avance->finductor = $request->finductor;
        $avance->save();
        return [
                'success'=>true
            ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}