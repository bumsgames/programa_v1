<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Bumsgames\Noticia;
use Bumsgames\BumsUser;

class NoticiaController extends Controller
{

    public function ShowNoticias(){
        $tutoriales = \Bumsgames\tutorial::All();
        $title = "Todas las Noticias";
        $noticias = Noticia::paginate(40);
        return view('noticias.all',compact('tutoriales','title','noticias'));
    }

    public function create(){
        $tutoriales = \Bumsgames\tutorial::All();
        $users = BumsUser::all();
        return view('noticias.create',compact('users','tutoriales'));
    }

    public function store(Request $request){

        $noticia = new Noticia;

        //setea el nombre con la hora actual para evitar nombres duplicados
        $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $imageref = $request->file('image');
        //Guarda la imagen en la pagina
        $imageref->move(base_path() . '/public/img/', $imageName);
        //Se guarda el nombre de la imagen en la bd
        $noticia->imagen = $imageName;

        $noticia->titulo = $request->titulo;
        $noticia->descripcion = $request->descripcion;
        $noticia->Fk_Creador = $request->autor;
        $noticia->save();

        return redirect('/noticias');
    }

    public function editar($id){
        $tutoriales = \Bumsgames\tutorial::All();
        $users = BumsUser::all();
        $noticia = Noticia::find($id);
        return view('noticias.edit',compact('users','tutoriales','noticia'));
    }

    public function change(Request $request, $id){
        $noticia = Noticia::find($id);
        if(isset($request->image)){
            //setea el nombre con la hora actual para evitar nombres duplicados
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imageref = $request->file('image');
            //Guarda la imagen en la pagina
            $imageref->move(base_path() . '/public/img/', $imageName);
            //Se guarda el nombre de la imagen en la bd
            $noticia->imagen = $imageName;
        }
        $noticia->titulo = $request->titulo;
        $noticia->descripcion = $request->descripcion;
        $noticia->save();

        return redirect('/noticias');
    }

    public function eliminar($id){
        $noticia = Noticia::find($id);
        $noticia->delete();
        return back();
    }

    public function LikeNoticia($id){
        $noticia = Noticia::find($id);
        $noticia->likes = $noticia->likes + 1;
        $noticia->save();

        return response()->json(array('success' => true));
    }

}
