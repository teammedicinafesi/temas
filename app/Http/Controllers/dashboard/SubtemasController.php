<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subtema;
use App\Apunte;

class SubtemasController extends Controller
{
    public function store(Request $request,$id){
		$request->validate([
            'subtema' => 'required',
        ]);

        $validar = Subtema::where([['subtema',$request->subtema],['tema_id',$id]])->count();

        if ($validar == 0) {
                $nuevo_subtema = new Subtema;
                $nuevo_subtema->subtema  = $request->subtema;
                $nuevo_subtema->tema_id  = $id;
                $nuevo_subtema->save();
                $subtema = Subtema::select('id','subtema')->where('id',$nuevo_subtema->id)->with(['apuntes', 'elementos'])->first();
                    
                return response()->json([
                    "mens"   => 'El subtema "'.$request->subtema.'" se creo exitosamente',
                    "color"  => "alert-success",
                    "subtema" => $subtema
                ],200);
        }
        else{
                return response()->json([
                    "mens" => 'El subtema "'.$request->subtema.'" ya estaba registrado',
                    "color" => "alert-warning"          
                ],200);
        }    	
    }

    public function update(Request $request, $id_tema, $id_subtema){
        $subtema = Subtema::findOrFail($id_subtema);
        $subtema_input = $request->subtema;

        $request->validate([
            'subtema' => 'required|min:3|max:150' 
        ]);

        if ($subtema_input == $subtema->subtema) {
            return response()->json([
                'mens'  => 'No se registran cambios',
                'color' => 'alert-warning'
            ],200); 
        }
        else{
            $validar = Subtema::where([['tema_id',$id_tema],['subtema',$subtema_input]])->count();
            if ($validar == 0) {
                $subtema->subtema = $request->subtema;
                $subtema->save();
                return response()->json([
                    'mens'  => 'Se registro el cambio correctamente',
                    'color' => 'alert-success',
                    'subtema' => $subtema
                ],200); 
            }
        }
    }

    public function delete($id){
        $subtema = Subtema::findOrFail($id);
        $nombre_subtema = $subtema->subtema;
        $id_subtema     = $subtema->id;
        $subtema->delete();
        return response()->json('El subtema "'.$nombre_subtema.'" se elimino correctamente',200); 
    }

    public function create_apunte(Request $request, $id){
        $subtema = Subtema::findOrFail($id);
        $apunte  = $subtema->apuntes()->create(['apunte' => $request->apunte]);
        
        return response()->json([
            'apunte' => $apunte,
            'mensaje' => 'se registro correctamente'
        ]);
    }

    public function update_apunte(Request $request, $id_subtema, $id_apunte){
        $apunte = Apunte::findOrFail($id_apunte);
        $apunte->apunte = $request->apunte;
        $apunte->save();
        return response()->json([
            'mens' => 'Se registro el cambio correctamente'
        ]);
    }

    public function delete_apunte($id){
        $apunte = Apunte::findOrFail($id);
        $nombre_apunte = $apunte->apunte;
        $apunte->delete();
        return response()->json('El tema "'.$nombre_apunte.'" se elimino correctamente',200); 
    }

}
