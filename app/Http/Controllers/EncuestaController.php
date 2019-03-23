<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Bumsgames\Poll;
use Bumsgames\Poll_Option;

class EncuestaController extends Controller
{

    //Devuelve las encuestas en la vista administrativa
    public function ShowEncuestas()
    {
        $tutoriales = \Bumsgames\tutorial::All();
        $title = "Todas las Encuestas";
        $encuestas = Poll::paginate(40);
        return view('admin.encuestas.all', compact('tutoriales', 'title', 'encuestas'));
    }

    //Devuelve el formulario de creacion de una encuesta
    public function create()
    {
        $tutoriales = \Bumsgames\tutorial::All();
        return view('admin.encuestas.create', compact('tutoriales'));
    }

    //Crea una encuesta nueva
    public function store(Request $request)
    {
        $encuesta = new Poll;
        $encuesta->nombre = $request->titulo;
        $encuesta->save();
        //Devuelve el array de las opciones (todos los inputs comparten el mismo name para lograr esto)
        $opciones = $request->get('opcion');
        //Devuelve el array de colores
        $colores = $request->get('col_nom');
        $numero = 0;
        //Itera sobre las opciones y las guarda
        foreach ($opciones as $opcion) {
            $numero++;
            $opc = new Poll_Option;
            $opc->nombre = $opcion;
            $opc->Fk_Poll = $encuesta->id;
            $opc->color = $colores[$numero];
            $opc->save();
        }
        return redirect('/encuestas');
    }

    //Devuelve el formulario de edicion
    public function editar($id)
    {
        $tutoriales = \Bumsgames\tutorial::All();
        $encuesta = Poll::find($id);
        return view('admin.encuestas.edit', compact('tutoriales', 'encuesta'));
    }

    //Edita la encuesta
    public function change(Request $request, $id)
    {
        $encuesta = Poll::find($id);
        $encuesta->nombre = $request->titulo;
        $encuesta->save();
        //Devuelve el array de las opciones (todos los inputs comparten el mismo name para lograr esto)
        $opciones = $request->get('opcion');
        //Devuelve el array de colores
        $colores = $request->get('col_nom');
        $numero = 0;
        //Itera sobre las opciones y las guarda
        foreach ($opciones as $opcion) {
            $numero++;
            $opc = new Poll_Option;
            $opc->nombre = $opcion;
            $opc->Fk_Poll = $encuesta->id;
            $opc->color = $colores[$numero];
            $opc->save();
        }

        return redirect('/encuestas');
    }

    //Elimina una encuesta
    public function eliminar($id)
    {
        $encuesta = Poll::find($id);
        $opciones = Poll_Option::where('Fk_Poll', $id)->get();
        //Elimina todas las opciones de esa encuesta
        foreach ($opciones as $opcion) {
            $opcion->delete();
        }
        $encuesta->delete();
        return back();
    }

    //Vota por la opcion seleccionada
    public function Votar(Request $request, $id)
    {
        $encuesta = Poll_Option::find($id); //Se obtiene la opcion seleccionada y se guarda
        if (Session::has('opcion_voto')) { //Se comprueba que no haya votado antes
            if (Session::get('poll_voted') == $encuesta->Fk_Poll && $encuesta->id != Session::get('opcion_voto')) { //Se comprueba que no haya votado en el mismo poll
                $encuesta_ref = Poll_Option::find(Session::get('opcion_voto'));
                $encuesta_ref->contador = $encuesta_ref->contador - 1;
                $encuesta_ref->save();
            }
        }
        if ($encuesta->id != Session::get('opcion_voto')) {
            $encuesta->contador = $encuesta->contador + 1;
            $encuesta->save();
        }
        Session::put('opcion_voto', $encuesta->id);
        Session::put('poll_voted', $encuesta->Fk_Poll);

        return response()->json(array('success' => true));
    }

    //Funcion para el ajax para actualizar la encuesta con los nuevo resultados
    public function MostrarResultado()
    {
        $encuesta = \Bumsgames\Poll::where('estado', '1')->first();
        return view('admin.encuestas.section', compact('encuesta'));
    }

    //Activa/desactiva la encuesta
    public function ActivarEncuesta($id)
    {
        $ref_encuesta = \Bumsgames\Poll::find($id);

        if ($ref_encuesta->estado == 0) {
            $ref_encuestas = \Bumsgames\Poll::where('estado', '=', '1')->get();
            foreach ($ref_encuestas as $ref_enc) {
                $ref_enc->estado = 0;
                $ref_enc->save();
            }
            $ref_encuesta->estado = 1;
        } else {
            $ref_encuesta->estado = 0;
        }
        $ref_encuesta->save();
        return redirect('/encuestas');
    }

    //Elimina una opcion individual
    public function EliminarOpcion($id)
    {
        $opcion = \Bumsgames\Poll_Option::find($id);
        $opcion->delete();
        return 1;
    }
}
