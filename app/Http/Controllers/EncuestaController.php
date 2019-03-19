<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Session;
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
        $encuesta = Poll_Option::find($id); //Se obtiene la opcion seleccionada
        if(Session::has('opcion_voto')){ //Se comprueba que no haya votado antes
            if(Session::get('poll_voted') == $encuesta->Fk_Poll && $encuesta->id != Session::get('opcion_voto')){ //Se comprueba que no haya votado en el mismo poll
                $encuesta_ref = Poll_Option::find(Session::get('opcion_voto'));
                $encuesta_ref->contador = $encuesta_ref->contador - 1;
                $encuesta_ref->save();
            }
        }
        if($encuesta->id != Session::get('opcion_voto')){
            $encuesta->contador = $encuesta->contador + 1;
            $encuesta->save();
        }
        Session::put('opcion_voto',$encuesta->id);
        Session::put('poll_voted',$encuesta->Fk_Poll);

        return response()->json(array('success' => true));
    }

    public function MostrarResultado(){
        $encuesta = \Bumsgames\Poll::where('estado','1')->first();
        return view('encuestas.section',compact('encuesta'));
    }

    public function ActivarEncuesta($id){
        $ref_encuesta = \Bumsgames\Poll::find($id);

        if($ref_encuesta->estado == 0){
            $ref_encuestas = \Bumsgames\Poll::where('estado','=','1')->get();
            foreach($ref_encuestas as $ref_enc){
                $ref_enc->estado = 0;
                $ref_enc->save();
            }
            $ref_encuesta->estado = 1;
        }
        else{
            $ref_encuesta->estado = 0;
        }
        $ref_encuesta->save();
        

        return redirect('/encuestas');
    }
}
