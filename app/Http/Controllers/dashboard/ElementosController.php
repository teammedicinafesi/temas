<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Elemento;

class ElementosController extends Controller
{
    public function store(Request $request, $id){
    	$request->validate([
            'elemento' => 'required',
        ]);
        $validar = Elemento::where([['elemento',$request->elemento],['subtema_id',$id]])->count();

        if ($validar == 0) {
                $nuevo_elemento = new Elemento;
                $nuevo_elemento->elemento  = $request->elemento;
                $nuevo_elemento->subtema_id  = $id;
                $nuevo_elemento->save();
                $elemento = Elemento::select('id','elemento')->where('id',$nuevo_elemento->id)->first();
                    
                return response()->json([
                    "mens"   => 'El elemento "'.$request->elemento.'" se creo exitosamente',
                    "color"  => "alert-success",
                    "elemento" => $elemento
                ],200);
        }
        else{
                return response()->json([
                    "mens" => 'El elemento "'.$request->elemento.'" ya estaba registrado',
                    "color" => "alert-warning"          
                ],200);
        } 
    }
}
