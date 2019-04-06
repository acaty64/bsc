<?php

namespace App\Http\Controllers;

use App\Objetivo;
use Illuminate\Http\Request;

class ObjetivoController extends Controller
{
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
        $objetivo = Objetivo::create([
            'wobjetivo' => $request->wobjetivo,
            'incidencia' => $request->incidencia,
            'perspectiva_id' => $request->perspectiva_id         
        ]);
        return ['success' => true, 'objetivo_id' => $objetivo->id];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\objetivo  $objetivo
     * @return \Illuminate\Http\Response
     */
    public function show(objetivo $objetivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\objetivo  $objetivo
     * @return \Illuminate\Http\Response
     */
    public function edit(objetivo $objetivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\objetivo  $objetivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $objetivo = Objetivo::findOrFail($request->id);
        $objetivo->wobjetivo = $request->wobjetivo;
        $objetivo->incidencia = $request->incidencia;
        $objetivo->perspectiva_id = $request->perspectiva_id;

        $objetivo->save();

        return ['success' => true];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\objetivo  $objetivo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $objetivo = Objetivo::findOrFail($id);

        $objetivo->delete();

        return ['success' => true];
    }
}
