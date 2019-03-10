<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Bumsgames\Coupon;

class CuponesController extends Controller
{

    public function create(){
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
        return view('descuento.create',compact('pago_sin_confirmar','comments_por_aprobar','tutoriales'));
    }

    public function editar($id){
        $cupones = coupon::find($id);
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
        return view('descuento.edit',compact('pago_sin_confirmar','comments_por_aprobar','cupones','tutoriales'));
    }

    public function edit(Request $request, $id){
        $cupones = Coupon::find($id);

        $cupones->descuento = $request->descuento;
        $cupones->disponible = $request->disponible;
        $cupones->codigo = $request->codigo;
        $cupones->nota_cupon = $request->nota_cupon;
        $cupones->save();
        
        return redirect('/cupones')->with('success','Cupon Editado');
    }

    public function store(Request $request){
        $this->validate($request,[
            'descuento' => 'required',
            'disponible' => 'required',
            'codigo' => 'required',
        ]);
        $cupon = new Coupon;
        $cupon->fk_empleado=$request->de_usuario;
        $cupon->descuento=  $request->descuento;
        $cupon->disponible=  $request->disponible;
        $cupon->codigo =  $request->codigo;
        $cupon->nota_cupon =  $request->nota_cupon;

        $cupon->save();
        
        return redirect('/cupones')->with('success','Cupon Creado');
    }

    public function ShowCupones(){
        $tutoriales = \Bumsgames\tutorial::all();
        $pago_sin_confirmar = \Bumsgames\Pago::
        orderby('created_at', 'desc')
        ->where(function ($query) {
         $query->where('verificado','<=',0)
         ->orWhere('entregado','<=',0);
     })->get();
        $cupones = \Bumsgames\Coupon::orderby('id')
        ->paginate(10);
        $comments_por_aprobar = \Bumsgames\Comment::
        where('aprobado',NULL)
        ->orderby('created_at', 'desc')
        ->get();
        $cupones_cantidad = Coupon::orderby('created_at','desc')->get();
        $cupones_cantidad = $cupones_cantidad->count();
        return view('descuento.cupones', compact('pago_sin_confirmar','comments_por_aprobar','cupones','cupones_cantidad','tutoriales'));
    }

    
    public function eliminar($id){
        $cupones = coupon::find($id);
        $cupones->delete();
        return redirect('/cupones')->with('success','Cupon Eliminado');    
    }
}
