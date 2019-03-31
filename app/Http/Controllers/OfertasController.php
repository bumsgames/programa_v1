<?php

namespace Bumsgames\Http\Controllers;

use Bumsgames\Oferta;
use Illuminate\Http\Request;

class OfertasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $offer = new Oferta;
        $offer->name = $request->nombre_ofer;
        $offer->telefono = $request->telefono_ofer;
        $offer->oferta = $request->oferta_ofer;
        $offer->estado = 0;
        $offer->Fk_article = $request->art_ofer;
        $offer->save();

        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Bumsgames\Oferta  $oferta
     * @return \Illuminate\Http\Response
     */
    public function show(Oferta $oferta)
    {
        $tutoriales = \Bumsgames\tutorial::All();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
        ->where(function ($query) {
            $query->where('verificado', '<=', 0)
                ->orWhere('entregado', '<=', 0);
        })->get();
        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();
        $title = "Ofertas por revisar";
        $ofertas = Oferta::where("estado",'0')->paginate(40);
        return view('admin.ofertas.ofertas', compact('tutoriales', 'title', 'ofertas','pago_sin_confirmar','comments_por_aprobar'));
    }

    public function show_a(Oferta $oferta)
    {
        $tutoriales = \Bumsgames\tutorial::All();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
        ->where(function ($query) {
            $query->where('verificado', '<=', 0)
                ->orWhere('entregado', '<=', 0);
        })->get();
        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();
        $title = "Ofertas Aprobadas";
        $ofertas = Oferta::where("estado",'1')->paginate(40);
        return view('admin.ofertas.ofertas', compact('tutoriales', 'title', 'ofertas','pago_sin_confirmar','comments_por_aprobar'));
    }

    public function show_r(Oferta $oferta)
    {
        $tutoriales = \Bumsgames\tutorial::All();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
        ->where(function ($query) {
            $query->where('verificado', '<=', 0)
                ->orWhere('entregado', '<=', 0);
        })->get();
        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();
        $title = "Ofertas Rechazadas";
        $ofertas = Oferta::where("estado",'2')->paginate(40);
        return view('admin.ofertas.ofertas', compact('tutoriales', 'title', 'ofertas','pago_sin_confirmar','comments_por_aprobar'));
    }

    public function AprobarOferta($id){
        $oferta = Oferta::find($id);
        $oferta->estado = 1;
        $oferta->save();
        return response()->json(['success'=>true]);
    }

    public function RechazarOferta($id){
        $oferta = Oferta::find($id);
        $oferta->estado = 2;
        $oferta->save();
        return response()->json(['success'=>true]);
    }
}
