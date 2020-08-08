<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modulo;

class ModulosController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

    public function modulos(){
    	return view('user.master');
    }

    public function listado(Request $request){
    	    
    	$id_usuario = auth()->id();
 
    	$modulos = Modulo::select('id','modulo')->where('user_id',$id_usuario)->orderBy('id', 'asc')->get();
    	
    	return response()->json([
    		'modulos' => $modulos,
    		'otro'    => 2
    	],200);

    }

    public function store(Request $request){
 		$request->validate([
            'modulo' => 'required',
        ]);

        $id_usuario = auth()->id();
        $validar    = Modulo::where([['modulo',$request->modulo],['user_id',$id_usuario]])->count();

        if ($validar == 0) {
                $nuevo_modulo = new Modulo;
                $nuevo_modulo->modulo  = $request->modulo;
                $nuevo_modulo->user_id = $id_usuario;
                $nuevo_modulo->save();
                $modulo = Modulo::select('id','modulo')->where('id',$nuevo_modulo->id)->first();
                //return $nuevo_modulo;
                    
                return response()->json([
                    "mens"   => 'El modulo "'.$request->modulo.'" se creo exitosamente',
                    "color"  => "alert-success",
                    "modulo" => $modulo
                ],200);
        }
        else{
                return response()->json([
                    "mens" => 'El modulo "'.$request->modulo.'" ya estaba registrado',
                    "color" => "alert-warning"          
                ],200);
        }
 		
    }

    public function update(Request $request,$id){
        $modulo = Modulo::findOrFail($id);
        $modulo_input = $request->modulo;
        $id_usuario   = auth()->id();

        $data = $request->validate([
            'modulo' => 'required|min:3|max:120',
        ]);


        if ($request->modulo == $modulo->modulo) {
            return response()->json([
                "mens"  => "No ha realizado ningun cambio",
                "color" => "alert-warning"
            ],200);
            
        }
        else{

            $validar = Modulo::where([['user_id',$id_usuario],['modulo',$modulo_input]])->count();
            if ($validar == 0) {
            
                $modulo->modulo = $data['modulo'];
                $modulo->save();
                return response()->json([
                    "mens"   =>  "Se realizo el cambio de nombre correctamente",
                    "color"  =>  "alert-success",
                    "modulo" =>  $modulo
                ],200);   

            }
            else{
                $que = Modulo::where([['user_id',$id_usuario],['modulo',$modulo_input]])->value('modulo');
                if ($que == $modulo->modulo) {
                    $modulo->modulo = $data['modulo'];
                    $modulo->save();
                    return response()->json([
                        "mens"   =>  "Se realizo el cambio de nombre correctamente",
                        "color"  =>  "alert-success",
                        "modulo" =>  $modulo
                    ],200);
                }
                else{
                    return response()->json([
                        "mens" => "El nombre que trata de ingresar ya se encuentra en uso",
                        "color" => "alert-warning"
                    ],200);
                }
            }

        }
    }

    public function delete($id){
        $modulo=Modulo::findOrFail($id);
        $nombre_modulo = $modulo->modulo;
        $modulo->delete();
        return response()->json('El modulo "'.$nombre_modulo.'" se elimino correctamente',200);
    }

}
