<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Bumsgames\Coupon;
use Auth;

class CuponesController extends Controller
{
    //Devuelve el formulario para crear un cupon
    public function create()
    {
        $tutoriales = \Bumsgames\tutorial::all();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
        ->where(function ($query) {
            $query->where('verificado', '<=', 0)
                ->orWhere('entregado', '<=', 0);
        })->get();
        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();

            $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
            ->get();
        return view('admin.descuento.create', compact('carrito','pago_sin_confirmar', 'comments_por_aprobar', 'tutoriales'));
    }

    //Devuelve el formulario para editar un cupon
    public function editar($id)
    {
        $cupones = coupon::find($id);
        $tutoriales = \Bumsgames\tutorial::all();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
            ->where(function ($query) {
                $query->where('verificado', '<=', 0)
                    ->orWhere('entregado', '<=', 0);
            })->get();
        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();
            $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
            ->get();
        return view('admin.descuento.edit', compact('carrito','pago_sin_confirmar', 'comments_por_aprobar', 'cupones', 'tutoriales'));
    }

    //Edita un comentario
    public function edit(Request $request, $id)
    {
        $cupones = Coupon::find($id);
        $cupones->descuento = $request->descuento;
        $cupones->disponible = $request->disponible;
        $cupones->codigo = $request->codigo;
        $cupones->nota_cupon = $request->nota_cupon;
        $cupones->save();

        return redirect('/cupones')->with('success', 'Cupon Editado');
    }

    //Crea un comentario
    public function store(Request $request)
    {
        $this->validate($request, [
            'descuento' => 'required',
            'disponible' => 'required',
            'codigo' => 'required',
        ]);
        $cupon = new Coupon;
        $cupon->fk_empleado = $request->de_usuario;
        $cupon->descuento =  $request->descuento;
        $cupon->disponible =  $request->disponible;
        $cupon->codigo =  $request->codigo;
        $cupon->nota_cupon =  $request->nota_cupon;
        $cupon->save();

        return redirect('/cupones')->with('success', 'Cupon Creado');
    }

    //Muestra los cupones
    public function ShowCupones()
    {
        $tutoriales = \Bumsgames\tutorial::all();
        $pago_sin_confirmar = \Bumsgames\Pago::orderby('created_at', 'desc')
            ->where(function ($query) {
                $query->where('verificado', '<=', 0)
                    ->orWhere('entregado', '<=', 0);
            })->get();
        $cupones = \Bumsgames\Coupon::orderby('id')
            ->paginate(10);
        $comments_por_aprobar = \Bumsgames\Comment::where('aprobado', null)
            ->orderby('created_at', 'desc')
            ->get();
        $cupones_cantidad = Coupon::orderby('created_at', 'desc')->get();
        $cupones_cantidad = $cupones_cantidad->count();

        $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
            ->get();

        return view('admin.descuento.cupones', compact('carrito','pago_sin_confirmar', 'comments_por_aprobar', 'cupones', 'cupones_cantidad', 'tutoriales'));
    }

    //Elimina el cupon
    public function eliminar($id)
    {
        $cupones = coupon::find($id);
        $cupones->delete();
        return redirect('/cupones')->with('success', 'Cupon Eliminado');
    }
}
