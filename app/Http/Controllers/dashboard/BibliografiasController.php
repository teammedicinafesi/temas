<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bibliografia;
use App\Tema;
use Illuminate\Support\Facades\DB;


class BibliografiasController extends Controller
{
    public function store(Request $request, $id){
    	$bibliografia = new Bibliografia;
    	$bibliografia->titulo      = $request->titulo;
    	$bibliografia->descripcion = $request->descripcion;
    	$bibliografia->tipo 	   = $request->tipo;
    	$bibliografia->cita        = $request->cita;
    	$bibliografia->link 	   = $request->link;
    	$bibliografia->save();

    	DB::table('bibliografia_tema')->insert(['bibliografia_id' => $bibliografia->id, 'tema_id' => $id]);

    	return response()->json([
            'bibliografia' => $bibliografia,
            'mens'         => 'Se registro exitosamente'    
        ]);    
    }
}
