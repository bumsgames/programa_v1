<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Bumsgames\Noticia;
use Bumsgames\BumsUser;
use Session;

class NoticiaController extends Controller
{
    //Muestra las noticias en la parte administrativa
    public function ShowNoticias()
    {
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
        ->where(function ($query) {
            $query->where('verificado', '<=', 0)
                ->orWhere('entregado', '<=', 0);
        })->get();
        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();
        $tutoriales = \Bumsgames\tutorial::All();
        $title = "Todas las Noticias";
        $noticias = Noticia::paginate(40);
        return view('admin.noticias.all', compact('tutoriales', 'title', 'noticias','comments_por_aprobar','pago_sin_confirmar'));
    }

    //Devuelve el formulario de creacion
    public function create()
    {
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
        ->where(function ($query) {
            $query->where('verificado', '<=', 0)
                ->orWhere('entregado', '<=', 0);
        })->get();
        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();
        $tutoriales = \Bumsgames\tutorial::All();
        $users = BumsUser::all();
        return view('admin.noticias.create', compact('users', 'tutoriales','comments_por_aprobar','pago_sin_confirmar'));
    }

    //Crea una nueva noticia
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|max:300',
        ]);
        $noticia = new Noticia;

        //setea el nombre con la hora actual para evitar nombres duplicados
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $imageref = $request->file('image');
        //Guarda la imagen en la pagina
        $imageref->move(base_path() . '/public/img/', $imageName);
        //Se guarda el nombre de la imagen en la bd
        $noticia->imagen = $imageName;

        $noticia->prioridad = $request->prioridad;
        $noticia->titulo = $request->titulo;
        $noticia->descripcion = $request->descripcion;
        $noticia->Fk_Creador = $request->autor;
        $noticia->save();

        return redirect('/noticias');
    }

    //Devuelve el formulario de creacion de una noticia
    public function editar($id)
    {
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
        ->where(function ($query) {
            $query->where('verificado', '<=', 0)
                ->orWhere('entregado', '<=', 0);
        })->get();
        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();
        $tutoriales = \Bumsgames\tutorial::All();
        $users = BumsUser::all();
        $noticia = Noticia::find($id);
        return view('admin.noticias.edit', compact('users', 'tutoriales', 'noticia','comments_por_aprobar','pago_sin_confirmar'));
    }

    //edita una noticia
    public function change(Request $request, $id)
    {
        if (isset($request->image)) {
            $this->validate($request, [
                'image' => 'required|max:300',
            ]);
        }
        $noticia = Noticia::find($id);
        if (isset($request->image)) {
            //setea el nombre con la hora actual para evitar nombres duplicados
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imageref = $request->file('image');
            //Guarda la imagen en la pagina
            $imageref->move(base_path() . '/public/img/', $imageName);
            //Se guarda el nombre de la imagen en la bd
            $noticia->imagen = $imageName;
        }
        $noticia->prioridad = $request->prioridad;
        $noticia->titulo = $request->titulo;
        $noticia->descripcion = $request->descripcion;
        $noticia->save();

        return redirect('/noticias');
    }

    //Elimina una noticia
    public function eliminar($id)
    {
        $noticia = Noticia::find($id);
        $noticia->delete();
        return back();
    }

    //Da un like a la noticia
    public function LikeNoticia($id)
    {
        //Comprueba que no haya dado like ya a esa noticia
        if (!Session::has('liked') || !in_array($id, Session::get('liked'))) {
            $noticia = Noticia::find($id);
            $noticia->likes = $noticia->likes + 1;
            $noticia->save();
            Session::push('liked', $noticia->id);
            return response()->json(array('success' => true));
        }

        return response()->json(array('success' => false));
    }
}
