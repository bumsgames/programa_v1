<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Bumsgames\Comment;
use Auth;
use Illuminate\Support\Facades\DB;


use Carbon\Carbon;

class CommentController extends Controller
{
    //Guarda un comentario
    public function store(Request $request)
    {
        //Si el usuario envio un comentario sin mensaje devuelve error
        if (!isset($request->comentario)) {
            return back()->with('errormessage', 'No puedes enviar un mensaje sin contenido!');
        }
        //Crea el comentario
        $comment = new Comment;
        //Si es un usuario logueado
        if (Auth::guard('client')->check()) {
            //Si decidio mostrar su nombre
            if ($request->opcion == 1) {
                $comment->id_comentario = Auth::guard('client')->user()->id;
                $comment->nombre = Auth::guard('client')->user()->name . ' ' . Auth::guard('client')->user()->lastname;
            } 
            //Si quiere mostrarse anonimo
            else if ($request->opcion == '2') {
                $comment->nombre = 'Anonimo';
            }
        } else {
            //Si quiere mostrarse anonimo
            if (is_null($request->nombre)) {
                $comment->nombre = 'Anonimo';
            } 
            //Si introdujo un nombre para mostrar
            else {
                $comment->nombre = $request->nombre;
            }
        }
        //Guarda los datos
        $comment->texto = $request->comentario;
        $comment->aprobado = null;
        $comment->fecha_comentado = Carbon::now();
        $comment->fecha_aprobado = null;
        $comment->save();


        return back()->with('message', 'Tu mensaje ha sido enviado con exito!');
    }

    //Muestra todos los comentarios 
    public function ShowComentariosAll()
    {
        $comentarios = DB::table('comment')->select('*')
            ->orderby('created_at', 'DESC')
            ->paginate(5);
        $tutoriales = \Bumsgames\tutorial::all();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
            ->where(function ($query) {
                $query->where('verificado', '<=', 0)
                    ->orWhere('entregado', '<=', 0);
            })->get();

        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();
        $comentarios_cantidad = Comment::orderby('created_at', 'desc')->get();
        $comentarios_cantidad = $comentarios_cantidad->count();
        return view('admin.comments.comentariosadminall', compact('pago_sin_confirmar', 'comments_por_aprobar', 'comentarios', 'comentarios_cantidad', 'tutoriales'));
    }

    //Muestra los comentarios aprobados
    public function ShowComentariosAprobados()
    {
        $comentarios = Comment::orderby('created_at', 'desc')
            ->where('aprobado', 1)
            ->paginate(5);
        $tutoriales = \Bumsgames\tutorial::all();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
            ->where(function ($query) {
                $query->where('verificado', '<=', 0)
                    ->orWhere('entregado', '<=', 0);
            })->get();
        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();
        $comentarios_cantidad = Comment::orderby('created_at', 'desc')->where('aprobado', 1)->get();
        $comentarios_cantidad = $comentarios_cantidad->count();
        return view('admin.comments.comentariosadminaprobados', compact('pago_sin_confirmar', 'comments_por_aprobar', 'comentarios', 'comentarios_cantidad', 'tutoriales'));
    }

    //Muestra los comentarios rechazados
    public function ShowComentariosRechazados()
    {
        $comentarios = Comment::orderby('created_at', 'desc')
            ->where('aprobado', 0)
            ->paginate(5);
        $tutoriales = \Bumsgames\tutorial::all();
        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
            ->where(function ($query) {
                $query->where('verificado', '<=', 0)
                    ->orWhere('entregado', '<=', 0);
            })->get();

        $comentarios_cantidad = Comment::orderby('created_at', 'desc')->where('aprobado', 0)->get();
        $comentarios_cantidad = $comentarios_cantidad->count();
        return view('admin.comments.comentariosadminrechazados', compact('pago_sin_confirmar', 'comments_por_aprobar', 'comentarios', 'comentarios_cantidad', 'tutoriales'));
    }

    //Muestra los comentarios pendientes
    public function ShowComentariosPendientes()
    {
        $comentarios = Comment::orderby('created_at', 'desc')
            ->where('aprobado', null)
            ->paginate(5);
        $tutoriales = \Bumsgames\tutorial::all();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
            ->where(function ($query) {
                $query->where('verificado', '<=', 0)
                    ->orWhere('entregado', '<=', 0);
            })->get();

        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();
        $comentarios_cantidad = Comment::orderby('created_at', 'desc')->where('aprobado', null)->get();
        $comentarios_cantidad = $comentarios_cantidad->count();
        return view('admin.comments.comentariosadminpendientes', compact('pago_sin_confirmar', 'comments_por_aprobar', 'comentarios', 'comentarios_cantidad', 'tutoriales'));
    }

    //Metodo para aprobar comentario
    public function aprobarcomentario($id)
    {
        $comentario = Comment::find($id);
        $comentario->aprobado = 1;
        $comentario->fecha_aprobado = Carbon::now();
        $comentario->save();
        return back();
    }

    // Metodo para Rechazar comentario
    public function rechazarcomentario($id)
    {
        $comentario = Comment::find($id);
        $comentario->aprobado = 0;
        $comentario->fecha_aprobado = Carbon::now();

        $comentario->save();
        return back();
    }
    
    // Metodo para eliminar comentario
    public function eliminarcomentario($id)
    {
        $comentario = Comment::find($id);
        $comentario->delete();
        return back();
    }
}
