<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Bumsgames\Poll;
use Bumsgames\Poll_Option;

class EncuestaController extends Controller
{
    
    public function ShowEncuestas(){
        $tutoriales = \Bumsgames\tutorial::All();
        $title = "Todas las Encuestas";
        $encuestas = Poll::paginate(40);
        return view('encuestas.all',compact('tutoriales','title','encuestas'));
    }

    public function create(){
        $tutoriales = \Bumsgames\tutorial::All();
        return view('encuestas.create',compact('tutoriales'));
    }

    public function store(Request $request){

        $encuesta = new Poll;

        $encuesta->nombre = $request->titulo;
        $encuesta->save();

        $opciones = $request->get('opcion');
        $colores = $request->get('col_nom');
        $numero = 0;
        foreach($opciones as $opcion){
            $numero++;
            $opc = new Poll_Option;
            $opc->nombre = $opcion;
            $opc->Fk_Poll = $encuesta->id;
            $opc->color = $colores[$numero];
            $opc->save();
        }


        return redirect('/encuestas');
    }

    public function editar($id){
        $tutoriales = \Bumsgames\tutorial::All();
        $encuesta = Poll::find($id);
        return view('encuestas.edit',compact('tutoriales','encuesta'));
    }

    public function change(Request $request, $id){
        $encuesta = Poll::find($id);
        $encuesta->nombre = $request->titulo;
        $encuesta->save();

        $opciones = $request->get('opcion');
        $colores = $request->get('col_nom');
        $numero = 0;

        foreach($opciones as $opcion){
            $numero++;
            $opc = new Poll_Option;
            $opc->nombre = $opcion;
            $opc->Fk_Poll = $encuesta->id;
            $opc->color = $colores[$numero];
            $opc->save();
        }

        return redirect('/encuestas');
    }

    public function eliminar($id){
        $encuesta = Poll::find($id);
        $opciones = Poll_Option::where('Fk_Poll',$id)->get();

        foreach($opciones as $opcion){
            $opcion->delete();
        }
        $encuesta->delete();
        return back();
    }

    public function Votar(Request $request, $id){
        $encuesta = Poll_Option::find($id);
        $encuesta->contador += 1;
        $encuesta->save();

        return response()->json(array('success' => true));
    }
}
