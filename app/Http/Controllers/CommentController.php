<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Bumsgames\Comment;
use Bumsgames\Client;
use Auth;
use Illuminate\Support\Facades\DB;


use Carbon\Carbon;

class CommentController extends Controller
{
    public function store(Request $request){
        if(!isset($request->comentario)){
            return back()->with('errormessage', 'No puedes enviar un mensaje sin contenido!');
        }

        
            $user = Auth::guard('client');
        $comment = new Comment;
        if(Auth::guard('client')->check()){ 
            if($request->opcion==1){
                $comment->id_comentario = Auth::guard('client')->user()->id;
                $comment->nombre = Auth::guard('client')->user()->name.' '.Auth::guard('client')->user()->lastname;
            }
            else if($request->opcion=='2'){
                $comment->nombre = 'Anonimo';
            }
        }
        else{
            if(is_null($request->nombre)){
                $comment->nombre = 'Anonimo';
            }
            else{
                $comment->nombre = $request->nombre;
            }
        }
        $comment->texto= $request->comentario;
        $comment->aprobado= NULL;
        $comment->fecha_comentado = Carbon::now();
        $comment->fecha_aprobado = NULL;
        $comment->save();
        

        return back()->with('message', 'Tu mensaje ha sido enviado con exito!');
    }
    //Muestra todos los comentarios 
    public function ShowComentariosAll(){
        $comentarios = DB::table('comment')->select('*')
        ->orderby('created_at','DESC')
        ->paginate(5);
        $tutoriales = \Bumsgames\tutorial::all();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

        $comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
        $comentarios_cantidad = Comment::orderby('created_at','desc')->get();
        $comentarios_cantidad = $comentarios_cantidad->count();
        return view('comments.comentariosadminall', compact('pago_sin_confirmar','comments_por_aprobar','comentarios','comentarios_cantidad','tutoriales'));
    }
    //Muestra los comentarios aprobados

    public function ShowComentariosAprobados(){
        $comentarios = Comment::orderby('created_at','desc')
        ->where('aprobado', 1)
        ->paginate(5);
        $tutoriales = \Bumsgames\tutorial::all();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();
        $comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
        $comentarios_cantidad = Comment::orderby('created_at','desc')->where('aprobado', 1)->get();
        $comentarios_cantidad = $comentarios_cantidad->count();
        return view('comments.comentariosadminaprobados', compact('pago_sin_confirmar','comments_por_aprobar','comentarios','comentarios_cantidad','tutoriales'));
    }
    //Muestra los comentarios rechazados

    public function ShowComentariosRechazados(){
        $comentarios = Comment::orderby('created_at','desc')
        ->where('aprobado', 0)
        ->paginate(5);
        $tutoriales = \Bumsgames\tutorial::all();
        $comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
        $pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

        $comentarios_cantidad = Comment::orderby('created_at','desc')->where('aprobado', 0)->get();
        $comentarios_cantidad = $comentarios_cantidad->count();
        return view('comments.comentariosadminrechazados', compact('pago_sin_confirmar','comments_por_aprobar','comentarios','comentarios_cantidad','tutoriales'));
    }

    //Muestra los comentarios pendientes

    public function ShowComentariosPendientes(){
        $comentarios = Comment::orderby('created_at','desc')
        ->where('aprobado', NULL)
        ->paginate(5);
        $tutoriales = \Bumsgames\tutorial::all();
		$pago_sin_confirmar = \Bumsgames\Pago::
		orderby('created_at', 'desc')
		->where(function ($query) {
			$query->where('verificado','<=',0)
			->orWhere('entregado','<=',0);
		})->get();

        $comments_por_aprobar = \Bumsgames\Comment::
		where('aprobado',NULL)
		->orderby('created_at', 'desc')
		->get();
        $comentarios_cantidad = Comment::orderby('created_at','desc')->where('aprobado', NULL)->get();
        $comentarios_cantidad = $comentarios_cantidad->count();
        return view('comments.comentariosadminpendientes', compact('pago_sin_confirmar','comments_por_aprobar','comentarios','comentarios_cantidad','tutoriales'));
    }
    //Metodo para aprobar comentario

    public function aprobarcomentario($id){
        $comentario = Comment::find($id);
        $comentario->aprobado=1;
        $comentario->fecha_aprobado=Carbon::now();
        $comentario->save();
        return back();

    }
    // Metodo para Rechazar comentario

    public function rechazarcomentario($id){
        $comentario = Comment::find($id);
        $comentario->aprobado=0;
        $comentario->fecha_aprobado=Carbon::now();

        $comentario->save();
        return back();
    }
    // Metodo para eliminar comentario

    public function eliminarcomentario($id){
        $comentario = Comment::find($id);
        $comentario->delete();
        return back();
    }
}
