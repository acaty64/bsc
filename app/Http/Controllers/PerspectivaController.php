<?php

namespace App\Http\Controllers;

use App\Perspectiva;
use Illuminate\Http\Request;

class PerspectivaController extends Controller
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
        $perspectiva = Perspectiva::create([
            'wperspectiva' => $request->wperspectiva            
        ]);
        return ['success' => true, 'perspectiva_id' => $perspectiva->id];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\perspectiva  $perspectiva
     * @return \Illuminate\Http\Response
     */
    public function show(perspectiva $perspectiva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\perspectiva  $perspectiva
     * @return \Illuminate\Http\Response
     */
    public function edit(perspectiva $perspectiva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\perspectiva  $perspectiva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $perspectiva = Perspectiva::findOrFail($request->id);
        $perspectiva->wperspectiva = $request->wperspectiva;

        $perspectiva->save();

        return ['success' => true];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\perspectiva  $perspectiva
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perspectiva = Perspectiva::findOrFail($id);

        $perspectiva->delete();

        return ['success' => true];
    }
}
