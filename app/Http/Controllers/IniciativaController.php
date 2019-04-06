<?php

namespace App\Http\Controllers;

use App\Iniciativa;
use Illuminate\Http\Request;

class IniciativaController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $iniciativa = Iniciativa::create([
            'winiciativa' => $request->winiciativa,
            'inductor' => $request->inductor,
            'indicador' => $request->indicador,
            'meta' => $request->meta,
            'incidencia' => $request->incidencia,
            'objetivo_id' => $request->objetivo_id
        ]);
        return ['success' => true, 'iniciativa_id' => $iniciativa->id];
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        $user = Iniciativa::findOrFail($request->id);
        $user->winiciativa = $request->winiciativa;
        $user->inductor = $request->inductor;
        $user->indicador = $request->indicador;
        $user->meta = $request->meta;
        $user->incidencia = $request->incidencia;
        $user->objetivo_id = $request->objetivo_id;

        $user->save();

        return ['success' => true];
    }

    public function destroy($id)
    {
        $user = Iniciativa::findOrFail($id);

        $user->delete();

        return ['success' => true];
    }
}
