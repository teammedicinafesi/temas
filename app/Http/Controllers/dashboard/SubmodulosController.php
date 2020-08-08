<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modulo;
use App\Submodulo;

class SubmodulosController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function temas($id){
    	return view('user.master');
    }
   
    public function despachador($id){

    	$modulo      = Modulo::select('id','modulo')->where('id',$id)->first();
        //$submodulos  = Submodulo::select('id','submodulo')->where('modulo_id',$id)->get();

        $submodulos  = Submodulo::select('id','submodulo')->where('modulo_id',$id)->with('temas')->get();
        

    	return response()->json([
    		'modulo'    => $modulo,
            'submodulos' => $submodulos
    	]);
    }

    public function store(Request $request,$id){
    	$request->validate([
            'submodulo' => 'required',
        ]);

        $id_usuario = auth()->id();
        $validar    = Submodulo::where([['submodulo',$request->submodulo],['modulo_id',$id]])->count();

        if ($validar == 0) {
                $nuevo_submodulo = new Submodulo;
                $nuevo_submodulo->submodulo  = $request->submodulo;
                $nuevo_submodulo->modulo_id  = $id;
                $nuevo_submodulo->save();
                $submodulo = Submodulo::select('id','submodulo')->where('id',$nuevo_submodulo->id)->with('temas')->first();

                return response()->json([
                    "mens"   => 'El submodulo "'.$request->submodulo.'" se creo exitosamente',
                    "color"  => "alert-success",
                    "submodulo" => $submodulo
                ],200);
        }
        else{
                return response()->json([
                    "mens" => 'El submodulo "'.$request->submodulo.'" ya estaba registrado',
                    "color" => "alert-warning"          
                ],200);
        }
    }

    public function update(Request $request,$id,$id_submodulo){
        
        $submodulo = Submodulo::findOrFail($id_submodulo);
        $submodulo_input = $request->submodulo;

        $request->validate([
            'submodulo' => 'required|min:3|max:150' 
        ]);

        if ($submodulo_input == $submodulo->submodulo) {
            return response()->json([
                'mens'  => 'No se registran cambios',
                'color' => 'alert-warning'
            ],200); 
        }
        else{
            $validar = Submodulo::where([['modulo_id',$id],['submodulo',$submodulo_input]])->count();
            if ($validar == 0) {
                $submodulo->submodulo = $request->submodulo;
                $submodulo->save();
                return response()->json([
                    'mens'  => 'Se registro el cambio correctamente',
                    'color' => 'alert-success',
                    'submodulo' => $submodulo
                ],200); 
            }
            else{
                $q = Submodulo::where([['modulo_id',$id],['Submodulo',$submodulo_input]])->value('submodulo');
                if ($q == $submodulo->submodulo) {
                    $submodulo->submodulo = $request->submodulo;
                    $submodulo->save();
                    return response()->json([
                        'mens'  => 'Se registro el cambio correctamente',
                        'color' => 'alert-success',
                        'submodulo' => $submodulo
                    ],200);
                }
                else{
                    return response()->json([
                        'mens'  => 'El nombre que esta ingresando ya estaba registrado',
                        'color' => 'alert-warning',
                        'submodulo' => $submodulo
                    ],200);  
                }
                
            }
        } 
    }

    public function delete($id){
        $submodulo = Submodulo::findOrFail($id);
        $nombre_submodulo = $submodulo->submodulo;
        $id_submodulo     = $submodulo->id;
        $submodulo->delete();
        return response()->json('El submodulo "'.$nombre_submodulo.'" se elimino correctamente',200); 
    }
}
