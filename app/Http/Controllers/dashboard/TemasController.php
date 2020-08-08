<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tema;
use App\Subtema;
use App\Submodulo;
use Illuminate\Support\Facades\DB;
use App\Bibliografia;

class TemasController extends Controller
{
	public function __construct(){
    	$this->middleware('auth');
    }

    public function index($id){
    	return view('user.master');
    }

    public function despachador($id){
        $tema = Tema::select('id','tema')->where('id',$id)->first();
        //$subtemas = Subtema::select('id','subtema')->where('tema_id',$id)->get();
        //$books = App\Book::with(['author', 'publisher'])->get();

        //$subtemas  = Subtema::select('id','subtema')->where('tema_id',$id)->with(['apuntes:id,apunte,apunte_id','elementos.apuntes:id,apunte,apunte_id'])->get();
        
        $subtemas = Subtema::select('id','subtema')->where('tema_id',$id)->with(['apuntes' => function ($query) {
            $query->select('apunte', 'id', 'apunte_id');
        },'elementos' => function($query){
            $query->select('elemento','id','subtema_id')->with('apuntes:id,apunte,apunte_id');
        }])->get();

        $bibliografias = $tema->bibliografias;


        return response()->json([
            'bibliografias' => $bibliografias,
            'tema' => $tema,
            'subtemas' => $subtemas
        ],200);
    }

    public function store(Request $request,$id_submodulo){
    	$request->validate([
            "tema" => "required|min:3|max:250"
        ]);

    	$submodulo = Submodulo::findOrFail($id_submodulo);
    	$validar = $submodulo->temas()->where('tema',$request->tema)->count();

    	if ($validar == 0) {
    		$tema = new Tema;
            $tema->tema = $request->tema;
            $tema->save();
            $tema = Tema::select('id','tema')->where('id',$tema->id)->first();
            DB::table('submodulo_tema')->insert(['submodulo_id' => $id_submodulo, 'tema_id' => $tema->id]);
            return response()->json([
                "mens"   => 'El tema "'.$request->tema.'" se creo exitosamente',
                "color"  => 'alert-success',
                "tema"   =>  $tema
            ],200);
    	}
    	else{
			return response()->json([
                "mens"   => 'El tema "'.$request->tema.'" ya estaba registrado en este submodulo',
                "color"  => 'alert-warning'
            ],200);
    	}

    }

    public function update(Request $request,$id_submodulo,$id_tema){
        //return $request->tema.'-'.$id_submodulo.'-'.$id_tema;
        $request->validate([
            'tema' => 'required|min:3|max:220' 
        ]);  
        $tema = Tema::findOrFail($id_tema);
        $tema->tema = $request->tema;
        $tema->save();
        return response()->json([
            'mens'  => 'Se registro el cambio correctamente',
            'color' => 'alert-success',
            'tema' => $tema
        ],200); 
  
    }

    public function delete($id){
        $tema = Tema::findOrFail($id);
        $nombre_tema = $tema->tema;
        $id_tema     = $tema->id;
        $tema->delete();
        return response()->json('El tema "'.$nombre_tema.'" se elimino correctamente',200); 
    }
}
