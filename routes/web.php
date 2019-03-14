<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Bumsgames\Notifications\TaskCompleted;
use Bumsgames\BumsUser;

Route::get('/markAsRead', function(){
	try{
		auth()->user()->unreadNotifications->markAsRead();
		return redirect()->back();
	}catch(\Exception $e){
		return redirect('/logloglog');
	}
})->name('markRead');

// BumsUserController
Route::resource('/logloglog','BumsUserController');
Route::post('/crear_usuario','BumsUserController@crear_usuario');
Route::post('/actualizar_user','BumsUserController@actualizar_user');
Route::post('/logueo','BumsUserController@logueo');

// ProgramController GET
Route::get('/ventas','ProgramController@ventas')->name('ventas');;
Route::get('/obtener_ventas','ProgramController@obtenerVentas')->name('obtener_ventas');
Route::post('/filtrar_ventas','ProgramController@filtrarVentas')->name('filtrar_ventas');
Route::get('/filtrar_ventas/{id_usuario}/{fecha_inicio}/{fecha_final}','ProgramController@obtenerVentas')->name('obtener_filtrar_ventas');
Route::get('/ventas_mias','ProgramController@ventas_mias')->name('ventas_mias');
Route::get('/filtrar_ventas_usuario/{id_usuario}','ProgramController@obtenerVentas')->name('obtener_filtrar_ventas_usuario');
Route::get('/clientes','ProgramController@clientes');
Route::get('/ordenes', 'ProgramController@ordenes');
Route::get('/configurar_tu_user', 'ProgramController@configurar_tu_user');
Route::get('/clientes_totales', 'ProgramController@clientes_totales');
Route::post('/devolver_articulo', 'ProgramController@devolver_articulo');
Route::get('/mis_clientes','ProgramController@mis_clientes');
Route::get('/movimientos_tuyos','ProgramController@movimientos_tuyos');
Route::get('/buscar_sale/{id}','ProgramController@buscar_sale');
Route::get('/ver_articulo_compra/{id}','ProgramController@ver_articulo_compra');
Route::get('/ver_detalle_compra/{id}','ProgramController@ver_detalle_compra');
Route::get('/buscar_usuario/{id}','ProgramController@buscar_usuario');
Route::get('/reporte','ProgramController@reporte');
Route::get('/pago_cliente','ProgramController@pago_cliente');
Route::get('/cuentas','ProgramController@cuentas');
Route::get('/cuentas_todas','ProgramController@cuentas_todas');
Route::get('/movimientos_tipo_banco','ProgramController@movimientos_tipo_banco');
Route::get('/movimientos_tipo_banco_filtro','ProgramController@movimientos_tipo_banco_filtro');
Route::get('/movimientos','ProgramController@movimientos');
Route::get('/obtener_movimientos/{movement}','ProgramController@obtener_movimientos')->name('obtener_movimientos');;
Route::get('/movimientos_tipo_banco_personal','ProgramController@movimientos_tipo_banco_personal');
Route::get('/logout', 'ProgramController@logout');
Route::get('/movimientos_tipo_banco_personal','ProgramController@movimientos_tipo_banco_personal');
Route::get('/movimientos_personal','ProgramController@movimientos_personal');
Route::get('/obtener_movimientos_personal','ProgramController@obtenerMovimientosPersonal')->name('obtener_movimientos_personal');
Route::get('/logout', 'ProgramController@logout');
Route::get('/movimientos_tipo_banco_personal','ProgramController@movimientos_tipo_banco_personal');
Route::get('/menu','ProgramController@index')->name('menu');
Route::get('/menu_usuario','ProgramController@menu_usuario');
Route::get('/formulario_registrar_articulo','ProgramController@formulario_registrar_articulo');
Route::get('/allArticles','ProgramController@allArticle');
Route::get('/misArticles','ProgramController@misArticles');
Route::get('articles_web','ProgramController@articles_web');
Route::get('/movimientos_tipo_banco_tuyos', 'ProgramController@movimientos_tipo_banco_tuyos');
Route::get('/guia', 'ProgramController@guia');
Route::get('/mostrar_articulo_cliente/{id}','ProgramController@mostrar_articulo_cliente');
Route::get('/categoria_articulo_admin','ProgramController@categoria_articulo_admin');
Route::get('/allArticlesOff','ProgramController@allArticlesOff');
Route::get('/prueba','ProgramController@prueba');
Route::get('/portal','ProgramController@portal');
Route::get('modo_ml','ProgramController@modo_ml');
Route::get('misArticles_lista_escrita','ProgramController@misArticles_lista_escrita');
// Route::get('/entrega/{nombre_cliente}/{apellido_cliente}/{articulo}/{email}/{password}/{category_id}',function($nombre_cliente, $apellido_cliente,$articulo,$email,$password,$category_id){
// 	return view('entrega', compact('nombre_cliente','apellido_cliente','articulo','email','password','category_id'));
// });
Route::get('/entrega/{id_articulo}/{nombre_cliente}/{apellido_cliente}','ProgramController@entrega');
Route::post('/modificacion_rapida','ProgramController@modicacion_rapida_get');
Route::get('/categoria_art/{category}','ProgramController@categoria_art');
Route::get('/categoria_artOff/{category}', 'ProgramController@categoria_artOff');

Route::get('/modo_funcion', 'ProgramController@modo_funcion');
Route::post('/m_pago', 'ProgramController@m_pago');
Route::get('/ver_tutoriales','ProgramController@verTutoriales');
Route::get('/tutorial/eliminar/{id}','ProgramController@eliminarTutorial');
Route::post('/tutorial/eliminarmodal/{id}','ProgramController@eliminarmodal');
Route::get('/tutorial/editar/{id}','ProgramController@editarTutorial');

// ProgramController POST
Route::post('/registrar_cuenta','ProgramController@registrar_cuenta');
Route::post('/registrar_orden','ProgramController@registrar_orden');
Route::post('/coincidencia','ProgramController@coincidencia');
Route::post('/coincidenciaArticulo','ProgramController@coincidenciaArticulo');
Route::post('/realizar_venta','ProgramController@realizar_venta');
Route::post('/ver_articulos','ProgramController@ver_articulos');
Route::post('/ordenes_cuenta','ProgramController@ordenes_cuenta')->name('ordenes_cuenta');
Route::post('/colocar_comision','ProgramController@colocar_comision');
Route::post('/realizar_modificacion','ProgramController@modificacion_rapida');
Route::post('/realizar_modificacion_cliente','ProgramController@realizar_modificacion_cliente');

Route::post('/guardar_reporte','ProgramController@guardar_reporte');
Route::post('/realizar_movimiento_financiero','ProgramController@realizar_movimiento_financiero');
Route::post('/actualizar_uss','ProgramController@actualizar_uss');
Route::post('/movimientos_filtro','ProgramController@movimientos_filtro');
Route::post('/movimientos_banco_filtro','ProgramController@movimientos_banco_filtro');
Route::post('/movimientos_tipo_banco_filtro','ProgramController@movimientos_tipo_banco_filtro');
Route::post('/agregar_cliente_articulo','ProgramController@agregar_cliente_articulo');
Route::post('/agregar_tutorial_modal','ProgramController@agregar_tutorial_modal');
Route::post('/allArticles_cat','ProgramController@allArticles_cat');
Route::post('/allArticles_catOff','ProgramController@allArticles_catOff');
Route::post('/movimientos_tipo_banco_personal_filtro','ProgramController@movimientos_tipo_banco_personal_filtro');
Route::any('/clientesFilt','ProgramController@clientesFilt');
Route::post('/exportar_movimientos','ProgramController@exportarMovimientos')->name('exportar_movimientos');
Route::any('/filtrar_movimientos_bums','ProgramController@filtrar_movimientos_bums')->name('filtrar_movimientos_bums');
Route::any('/aplicar_filtros_multiples','ProgramController@aplicar_filtros_multiples');
Route::post('guardar_comision','ProgramController@guardar_comision');
Route::post('cambiar_valor','ProgramController@cambiar_valor');
Route::post('articulos_bd','ProgramController@articulos_bd');
Route::any('articulosAllOrdenados','ProgramController@allOrdenados');
Route::post('elimina_cliente_articulo/{id}','ProgramController@elimina_cliente_articulo');
Route::post('eliminar_orden/{id}','ProgramController@eliminar_orden');
Route::post('devolverA','ProgramController@devolverA');
Route::post('portal','ProgramController@portal_guardar');
Route::get('visitas','ProgramController@visitas');
Route::get('/crear_tutorial','ProgramController@menuCrearTutorial');
Route::post('/creartutorial','ProgramController@crearTutorial');
Route::post('/editartutorial','ProgramController@editar_Tutorial');
Route::any('/ffiltrar_movimientos_bums_david','ProgramController@filtrar_movimientos_bums_david')->name('filtrar_movimientos_bums_david');
// HomeWorkController GET
Route::get('/homework','HomeworkController@index');
Route::get('/individual_duties','HomeworkController@tareas_mias');
Route::get('/actuales/{id}','HomeworkController@edit');
Route::get('/actualesOrden/{id}','HomeworkController@EnviarOrden');
Route::get('/actualCuent/{id}','HomeworkController@buscar_cuenta');
Route::get('/envios','HomeworkController@envios_actuales');
Route::get('/Arecibir','HomeworkController@envios_actuales_recibir');
Route::get('/imagenes','HomeworkController@imagenes');


// HomeWorkController POST
Route::post('/homeworkAdd','HomeworkController@store');
Route::post('/homeworkEdit/{id}','HomeworkController@update2');
Route::post('/eliminar_cliente', 'HomeWorkController@eliminar_cliente');
Route::post('/modificarEnvio/{id}','HomeworkController@modEnvio');
Route::post('/modificarCuenta/{id}','HomeworkController@modCuent');
Route::post('/eliminar_reporte/{id}','HomeworkController@eliminar_reporte');
Route::post('/delete_duties/{id}','HomeworkController@destroy');
Route::post('/delete_mov/{id}','HomeworkController@destroymov');
Route::post('/buscar_articulo','HomeworkController@buscar_articulo');
Route::post('/delete_uss/{id}','HomeworkController@destroyuss');
Route::post('/delete_articulo/{id}','HomeworkController@destroyArt');
Route::post('/delete_envios/{id}','HomeworkController@destroyEnv');
Route::post('/delete_imagen/{id}','HomeworkController@destroyImagen');
Route::post('/delete_account/{id}','HomeworkController@destroyAcc');
Route::post('/add_envios','HomeworkController@add_envios');
Route::post('/add_imagenes','HomeworkController@add_imagenes');

// ArticleController
Route::resource('/registrar_articulo', 'ArticleController');
Route::post('/modificar_Articulo', 'ArticleController@modificar_Articulo');


// WebController 
Route::get('/categorias', 'WebController@categorias');
Route::get('/articulos_web', 'WebController@articulos_web');
Route::get('/filtrar_articulos', 'WebController@filtrar_articulos');
Route::get('/send','ChatController@send2');
Route::get('/lista_escrita', 'WebController@lista_escrita');
Route::get('/articulos_oferta', 'WebController@articulos_oferta');
Route::get('/ayuda', 'WebController@ayuda');
Route::get('/adminpaneluser', 'WebController@adminpaneluser');
Route::get('/categoria_general/{categoria}', 'WebController@categoria_general');
Route::get('/prueba2', 'ControllerPrimary@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lala', 'WebController@lala');
Route::get('/','WebController@index');
Route::get('/buscar_articulo_bums', 'WebController@buscar_articulo_bums');
Route::get('/categoria_general','WebController@categoria_general');
Route::get('/articulos', 'WebController@articulos');
Route::get('/orden_a_pagar', 'WebController@orden_a_pagar');


// WebControllerPost
Route::post('/agregaCarro','WebController@agregaCarro');
Route::post('/borrarElementoCarrito', 'WebController@borrarElementoCarrito');
Route::post('/lista_escrita', 'WebController@lista_escrita');
Route::post('/lista_escrita2', 'WebController@lista_escrita2');
Route::post('/filtrar_articulos', 'WebController@filtrar_articulos');
Route::post('/articulos_oferta', 'WebController@articulos_oferta');
Route::post('/articulos/{categoria}', 'WebController@articulos');
Route::post('/categoria_general/{categoria}', 'WebController@categoria_general');
Route::get('/prueba', 'WebController@prueba');
Route::get('/buscar_articulo_bums', 'WebController@buscar_articulo_bums');
Route::post('/agregaCarro','WebController@agregaCarro');
Route::post('/categoria_general','WebController@categoria_general');
Route::post('/articulos_web', 'WebController@articulos_web');
Route::get('/articulos', 'WebController@articulos');
Route::post('/reportar_pago', 'WebController@reportar_pago');

// Cliente Login Get
Route::get('/login','WebController@login');

// Cliente Login Post
Route::post('/login','WebController@loginAuth');
//Cliente Logout
Route::get('/logout_user','WebController@logout');

Route::post('postComment','CommentController@store');
// Vista administrativa
Route::get('/comentariosaprobados','CommentController@ShowComentariosAprobados');
Route::get('/comentariosall','CommentController@ShowComentariosAll');
Route::get('/comentariosrechazados','CommentController@ShowComentariosRechazados');
Route::get('/comentariospendientes','CommentController@ShowComentariosPendientes');
Route::get('/comentario/aprobar/{id}','CommentController@aprobarcomentario');
Route::get('/comentario/rechazar/{id}','CommentController@rechazarcomentario');
Route::get('/comentario/eliminar/{id}','CommentController@eliminarcomentario');


//Cupones
Route::post('/canjear/{precio}','WebController@canjear');
Route::post('/cupones/crear','CuponesController@store');
Route::post('/cupones/editar/{id}','CuponesController@edit');

//Cupones Get
Route::get('/cupones','CuponesController@ShowCupones');
Route::get('/cupones/crear','CuponesController@create');
Route::get('/cupones/editar/{id}','CuponesController@editar');
Route::get('/cupones/eliminar/{id}','CuponesController@eliminar');

/*
--------------------------------
	Noticias - Administracion
--------------------------------
*/

//Devuelve todas las noticias
Route::get('/noticias','NoticiaController@ShowNoticias');
//Devuelve el formulario para crear noticias
Route::get('/noticias/crear','NoticiaController@create');
//Devuelve el formulario para editar noticias
Route::get('/noticias/editar/{id}','NoticiaController@editar');
//Elimina una noticia
Route::get('/noticias/eliminar/{id}','NoticiaController@eliminar');

//Guarda una nueva noticia
Route::post('/noticias/crear','NoticiaController@store');
Route::post('/noticias/editar/{id}','NoticiaController@change');

/*
------------------------------
	Noticias - Usuario
------------------------------
*/

//Actualiza los likes
Route::get('/noticialike/{id}','NoticiaController@LikeNoticia');

/*
------------------------------
	Miscelaneos
------------------------------
*/

//Articulos sin imagenes
Route::get('/articulosSinImagen','ProgramController@Articulos_Sin_Imagen');

//Agregar imagen
Route::post('/actualizarImagen/{id}','ProgramController@Actualizar_Imagen');

//Articulos sin peso
Route::get('/articulosSinPeso','ProgramController@Articulos_Sin_Peso');

//Agrega el peso
Route::post('/actualizarPeso/{id}','ProgramController@Actualizar_Peso');
