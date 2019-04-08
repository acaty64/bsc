<?php

namespace App\Http\Controllers\Api;

use App\Avance;
use App\Http\Controllers\Controller;
use App\Iniciativa;
use App\Programacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AvanceController extends Controller
{
    public function published($id)
    {
        $avance = Avance::findOrFail($id);
        $avance->published = true;
        $avance->save();
        return [
            'success' => true, 
            'published' => $avance->published 
        ];
    }
    public function getData($iniciativa_id)
    {
        $iniciativa = Iniciativa::findOrFail($iniciativa_id);
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

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function storeFileTemp(Request $request)
    {
        try {
            foreach (glob("storage/temporal/*.pdf") as $filename) {
               unlink($filename);
            }           
            $archivo = Storage::put('public/temporal', $request->filePDF);
        } catch (Exception $e) {
            return 'storeFileTemp error';
        }
        return [
            'success'=>true,
            'archivo'=>$archivo
        ];
    }

    public function storeFile(Request $request)
    {
        if($request->id > 0){
            $avance = Avance::findOrFail($request->id);
        }          
        if($request->filePDF == []){
            return [
                    'success'=>true,
                    'archivo'=>$avance->archivo,
                    'warchivo'=>$avance->warchivo,
                ];                
        }else{
            try {
                $archivo = Storage::put('public/avances', $request->filePDF);
                if($request->id > 0){
                    // $slash = strrpos($avance->archivo, "/")+1;
                    $filename = basename($avance->archivo);
                    // $filename = substr($avance->archivo, $slash);
                    // php artisan storage:link
                    $filepath = public_path('storage/avances/'.$filename);
                    if(is_file($filepath)) {
                        File::delete($filepath);
                        if(is_file($filepath)) {
                            $success = false;
                        }else{
                            $success = true;
                        }
                    }else{
                        $success = false;
                        dd( $filepath . " File does not exist");
                    }
                }else{
                    $success = true;
                }
            } catch (Exception $e) {
                $success = false;
            }
            return [
                    'success'=>$success,
                    'archivo'=>$archivo,
                    'warchivo'=>$request->filePDF->getClientOriginalName(),
                ];    
        }
    }

    public function store(Request $request)
    {
        if($request->id == 0){
            $avance = Avance::create([
                    'iniciativa_id' => $request->iniciativa_id,
                    'user_id' => $request->user_id,
                    'ejecutado' => $request->ejecutado,
                    'mes' => $request->mes,
                    'warchivo' => $request->warchivo,
                    'archivo' => $request->archivo, 
                ]);
        }else{
            $avance = Avance::findOrFail($request->id);
            $avance->user_id = $request->user_id;
            $avance->ejecutado = $request->ejecutado;
            $avance->warchivo = $request->warchivo;
            $avance->archivo = $request->archivo; 
        }
        try{
            $avance->save();
            $success = true;            
        } catch (Exception $e) {
            $success = false;
        }
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
        // $id = $request->id;
        // $avance = Avance::findOrFail($id);
        // $avance->user_id = $request->user_id;
        // $avance->ejecutado = $request->ejecutado;
        // $avance->mes = $request->mes;
        // $avance->finductor = $request->finductor;
        // $avance->save();
        // return [
        //         'success'=>true
        //     ];
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
