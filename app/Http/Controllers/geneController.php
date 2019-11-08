<?php

namespace Bumsgames\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;
use Bumsgames\Notifications\TaskCompleted;
use Bumsgames\BumsUser;
use Bumsgames\Carrito_Admin;
use Bumsgames\Movimiento;
use Bumsgames\Sales;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Session;

class geneController extends Controller
{
    //
    public function ubicacion()
    {
     $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();
     
     $ubicaciones = \Bumsgames\Ubicacion::All();
     
     return view ('admin.ubicacion', compact('ubicaciones','tutoriales','carrito'));
 }

 public function agg_ubicacion(Request $request)
 {
         	    // dd(	$request->all());
     $nombre = \Bumsgames\Ubicacion::create($request->all());

     $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();

     $ubicaciones = \Bumsgames\Ubicacion::All();
     
     return view ('admin.ubicacion', compact('ubicaciones','tutoriales','carrito'));

     
 }

  public function del_ubicacion(Request $request)
 {

     
     $id  = $request->eliminar_id;
      \Bumsgames\Ubicacion::find($id)->delete();;

     $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();

     $ubicaciones = \Bumsgames\Ubicacion::All();

    
     
     return view ('admin.ubicacion', compact('ubicaciones','tutoriales','carrito'));

 }
 
 public function mod_ubicacion(Request $request)
 {
    
     $ubicacion = \Bumsgames\Ubicacion::find($request->modificar_id);

     $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();
   
     return view ('admin.pubicacion_mod', compact('ubicacion','tutoriales','carrito'));

 } 
 public function modif_ubicacion(Request $request)
 {

       $ubicacion = \Bumsgames\Ubicacion::find($request->id);
       $ubicacion->fill($request->all());
       $ubicacion->save();

        $tutoriales = \Bumsgames\tutorial::All();
	     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
	     ->get();
       
     $ubicaciones = \Bumsgames\Ubicacion::All();
     
     return view ('admin.ubicacion', compact('ubicaciones','tutoriales','carrito'));

 }

 public function bancoEmisor(){
      // dd(1);
 	 $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();
     
     $bancosE = \Bumsgames\banco_emisor::All();
     
     return view ('admin.banco_emisor', compact('bancosE','tutoriales','carrito'));

 }
 public function agg_bancoE(Request $request){
 	 $nombre = \Bumsgames\banco_emisor::create($request->all());

      // dd(1);
 	 $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();
     $bancosE = \Bumsgames\banco_emisor::All();
     
     return view ('admin.banco_emisor', compact('bancosE','tutoriales','carrito'));  

 }
 public function del_bancos(Request $request){

     $id  = $request->eliminar_id;
      \Bumsgames\banco_emisor::find($id)->delete();;

     $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();

     $bancosE = \Bumsgames\banco_emisor::All();
     
     return view ('admin.banco_emisor', compact('bancosE','tutoriales','carrito'));  

 }
	 public function mod_bancos(Request $request){

     // dd(	$request->all());
     $bancos = \Bumsgames\banco_emisor::find($request->modificar_id);

     $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();
   
     return view ('admin.bancos_mod', compact('bancos','tutoriales','carrito'));

 }
  public function modif_banco(Request $request){

     // dd(	$request->all());

       $bancos = \Bumsgames\banco_emisor::find($request->id);
       $bancos->fill($request->all());
       $bancos->save();

       $tutoriales = \Bumsgames\tutorial::All();
	   $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
	     ->get();
       
       $bancosE = \Bumsgames\banco_emisor::All();
     
       return view ('admin.banco_emisor', compact('bancosE','tutoriales','carrito'));  


 }
   public function categorias(){

     // dd(	$request->all());

     $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();
     
     $categorias = \Bumsgames\Category::All();
     $Categoria_SubCategoria = \Bumsgames\Categoria_SubCategoria::All();

     return view ('admin.categoriasvw', compact('categorias','tutoriales','carrito','Categoria_SubCategoria'));

 }
 public function agg_categorias(Request $request){
      // dd(	$request->all());
 	$nombre = \Bumsgames\Category::create($request->all());


      // dd(1);
 	 $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();
     $categorias = \Bumsgames\Category::All();
     
     return view ('admin.categoriasvw', compact('categorias','tutoriales','carrito'));  

 }
 public function del_categorias(Request $request){


     \Bumsgames\Category::find($request->eliminar_id)->delete();;

 	$tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();
     $categorias = \Bumsgames\Category::All();
     
     return view ('admin.categoriasvw', compact('categorias','tutoriales','carrito')); 
 }
 public function mod_categorias(Request $request){

 	$categoria = \Bumsgames\Category::find($request->modificar_id);

     $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();

     $Categoria_SubCategoria = \Bumsgames\Categoria_SubCategoria::All();
      $Categoria_SubCategoria = \Bumsgames\Categoria_SubCategoria::All();
   
     return view ('admin.mod_category', compact('categoria','tutoriales','carrito','Categoria_SubCategoria'));
 }

 public function categorias_mod(Request $request){
 	    // dd(	$request->all());

 	   $categorys = \Bumsgames\Category::find($request->id);
       $categorys->fill($request->all());
       $categorys->save();

       $tutoriales = \Bumsgames\tutorial::All();
	   $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
	     ->get();

       
       $categorias = \Bumsgames\Category::All();  
       $Categoria_SubCategoria = \Bumsgames\Categoria_SubCategoria::All();
   
    return view ('admin.categoriasvw', compact('categorias','tutoriales','carrito','Categoria_SubCategoria')); 
 }

  public function sub_categorias(){

     // dd(	$request->all());

     $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();
     
     $subCategoria = \Bumsgames\Categoria_SubCategoria::All();
     
     return view ('admin.subCategorias', compact('subCategoria','tutoriales','carrito'));

 }
 public function agg_subCategorias(Request $request){

     // dd(	$request->all());

     \Bumsgames\Categoria_SubCategoria::create($request->All());
     $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();
     
     $subCategoria = \Bumsgames\Categoria_SubCategoria::All();
     
     return view ('admin.subCategorias', compact('subCategoria','tutoriales','carrito'));

 }
 public function del_subCategorias(Request $request){

      // dd(	$request->all());
     \Bumsgames\Categoria_SubCategoria::find($request->eliminar_id)->delete();;

 	$tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();
     $subCategoria = \Bumsgames\Categoria_SubCategoria::All();
     
     return view ('admin.subCategorias', compact('subCategoria','tutoriales','carrito')); 
 }

 public function mod_subCategorias(Request $request){
   
     $Subcategoria = \Bumsgames\Categoria_SubCategoria::find($request->modificar_id);

     $tutoriales = \Bumsgames\tutorial::All();
     $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
     ->get();
   
     return view ('admin.mod_Subcategory', compact('Subcategoria','tutoriales','carrito'));
 }
  public function  modif_subCategorias(Request $request){
   
       $categorys = \Bumsgames\Categoria_SubCategoria::find($request->id);
       $categorys->fill($request->all());
       $categorys->save();

       $tutoriales = \Bumsgames\tutorial::All();
	   $carrito = \Bumsgames\Carrito_Admin::with('articulo')->where('id_admin', Auth::id())
	     ->get();

       
       $subCategoria = \Bumsgames\Categoria_SubCategoria::All();  
   
    return view ('admin.subCategorias', compact('subCategoria','tutoriales','carrito')); 
 }

}