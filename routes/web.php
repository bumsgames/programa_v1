<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Bumsgames\Notifications\TaskCompleted;
use Bumsgames\BumsUser;

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

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
Route::post('/verifyPass','BumsUserController@verifyPass');

// ProgramController GET
Route::get('/factura/{id}','ProgramController@factura');
Route::get('/ver_ventas','ProgramController@ver_ventas');
Route::get('/mostrar_ventas','ProgramController@mostrar_ventas');
Route::get('/buscador_inteligente','ProgramController@buscador_inteligente');
Route::get('/mostrar_ventas2','ProgramController@mostrar_ventas2');
Route::get('/obtener_ventas','ProgramController@obtenerVentas')->name('obtener_ventas');
Route::post('/filtrar_ventas','ProgramController@filtrarVentas')->name('filtrar_ventas');
Route::get('/filtrar_ventas/{id_usuario}/{fecha_inicio}/{fecha_final}','ProgramController@obtenerVentas')->name('obtener_filtrar_ventas');
Route::get('/ventas_mias','ProgramController@ventas_mias')->name('ventas_mias');
Route::get('/filtrar_ventas_usuario/{id_usuario}','ProgramController@obtenerVentas')->name('obtener_filtrar_ventas_usuario');
Route::get('/clientes','ProgramController@clientes');
Route::get('/ordenes', 'ProgramController@ordenes');
Route::get('/configurar_tu_user', 'ProgramController@configurar_tu_user');
//Route::get('/clientes_totales', 'ProgramController@clientes_totales');
Route::post('/devolver_articulo', 'ProgramController@devolver_articulo');
Route::get('/facturacion','ProgramController@facturacion');
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
Route::get('/inventario/{id}','ProgramController@inventarioList');
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
Route::get('facuracion_coin', 'WebController@facuracion_coin');
Route::get('probando', 'WebController@probando');
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
Route::get('/descripcionArticulo/{id}','ProgramController@DescripcionArticulo');
Route::get('/Articulos_masCantidad','ProgramController@articulos_masCantidad');
Route::get('/ver_manual','ProgramController@ver_manual');


// ProgramController POST
// Route::post('/coincidencia_buscador_inteligente','ProgramController@coincidencia_buscador_inteligente');
Route::post('/registrar_cuenta','ProgramController@registrar_cuenta');
Route::post('/registrar_orden','ProgramController@registrar_orden');
Route::post('/coincidencia','ProgramController@coincidencia');
Route::post('/coincidenciaArticulo','ProgramController@coincidenciaArticulo');
Route::post('/realizar_venta','ProgramController@realizar_venta');
Route::post('/realizarVenta_v2','ProgramController@realizarVenta_v2');
Route::post('/ver_articulos','ProgramController@ver_articulos');
Route::post('/ordenes_cuenta','ProgramController@ordenes_cuenta')->name('ordenes_cuenta');
Route::post('/colocar_comision','ProgramController@colocar_comision');
Route::post('/realizar_modificacion','ProgramController@modificacion_rapida');
Route::post('/realizar_modificacion_cliente','ProgramController@realizar_modificacion_cliente');
Route::post('/agregaCarro_admin','ProgramController@agregaCarro_admin');
Route::post('/deleteCart_admin','ProgramController@deleteCart_admin');
Route::post('/eliminaTodoCarro_admin','ProgramController@deleteAllCart_admin');
Route::post('/filtrar_ventas_v2','ProgramController@filtrar_ventas_v2');
Route::post('/delete_venta_v2/{id}','ProgramController@delete_venta_v2');
Route::post('/imagenes', 'ProgramController@upload');
Route::get('/proyecto/imagenes', 'ProgramController@upload');


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

// GENESIS CONTROLLER
Route::get('/ubicacion','geneController@ubicacion');
Route::post('/agg_ubicacion','geneController@agg_ubicacion');
Route::post('/del_ubicacion','geneController@del_ubicacion');
Route::post('/mod_ubicacion','geneController@mod_ubicacion');
Route::post('/modif_ubicacion','geneController@modif_ubicacion');

//Controladores de Banco emisor
Route::get('/bancoEmisor','geneController@bancoEmisor');

Route::post('/agg_bancoE','geneController@agg_bancoE');
Route::post('/del_bancos','geneController@del_bancos');
Route::post('/mod_bancos','geneController@mod_bancos');
Route::post('/modif_banco','geneController@modif_banco');

//Controlador para categorias
Route::get('/categorias','geneController@categorias');
Route::post('/agg_categorias','geneController@agg_categorias');
Route::post('/del_categorias','geneController@del_categorias');
Route::post('/mod_categorias','geneController@mod_categorias');
Route::post('/categorias_mod','geneController@categorias_mod');

//Controlador sub_categorias
Route::get('/sub_categorias','geneController@sub_categorias');
Route::post('/agg_subCategorias','geneController@agg_subCategorias');
Route::post('/del_subCategorias','geneController@del_subCategorias');
Route::post('/mod_subCategorias','geneController@mod_subCategorias');
Route::post('/modif_subCategorias','geneController@modif_subCategorias');

//Controlador para moneda 
Route::get('/monedas','geneController@monedas');



//Cierre Genesis


// ArticleController
Route::resource('/registrar_articulo', 'ArticleController');
Route::post('/modificar_Articulo', 'ArticleController@modificar_Articulo');



// WebController 
//Route::get('/categorias', 'WebController@categorias');
Route::post('/coincidencia_buscador_inteligente','WebController@coincidencia_buscador_inteligente');
Route::get('/articulos_web', 'WebController@articulos_web');
Route::get('/articulos_web_cat/{id}/{categoria?}', 'WebController@articulos_web_cat');
Route::get('/filtrar_articulos', 'WebController@filtrar_articulos');
Route::get('/send','ChatController@send2');
Route::get('/lista_escrita', 'WebController@lista_escrita');
Route::get('/prueba_lista_escrita', 'WebController@prueba_lista_escrita');
Route::get('/articulos_oferta', 'WebController@articulos_oferta');
Route::get('/articulos_oferta_opc', 'WebController@articulos_oferta_opc');
Route::get('/ayuda', 'WebController@ayuda');
Route::get('/adminpaneluser', 'WebController@adminpaneluser');
Route::get('/categoria_general/{categoria}', 'WebController@categoria_general');
Route::get('/prueba2', 'ControllerPrimary@index');
Route::get('/lala', 'WebController@lala');
Route::get('/','WebController@index');
Route::get('/buscar_articulo_bums', 'WebController@buscar_articulo_bums');
Route::get('/buscar_articulo_bumsG', 'WebController@buscar_articulo_bumsG');
Route::get('/categoria_general','WebController@categoria_general');
Route::get('/articulos', 'WebController@articulos');
Route::get('/articulos2', 'WebController@articulos2');
Route::get('/orden_a_pagar', 'WebController@orden_a_pagar');
Route::get('/categoria/{id}', 'WebController@categoria');
Route::get('/subcategoria/{id}','WebController@subcategoria');
Route::get('/zona_prueba','WebController@zona_prueba');
Route::post('/upload','ProgramController@upload');




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
Route::get('/n_paginacion', 'WebController@n_paginacion');
Route::get('/cambio_ordenador', 'WebController@cambio_ordenador');
Route::get('/buscar_articulo_bums', 'WebController@buscar_articulo_bums');
Route::post('/agregaCarro','WebController@agregaCarro');
Route::post('/categoria_general','WebController@categoria_general');
Route::post('/articulos_web', 'WebController@articulos_web');
Route::get('/articulos', 'WebController@articulos');
Route::post('/reportar_pago', 'WebController@reportar_pago');
Route::post('/articulos', 'WebController@articulos');
Route::get('/filtros_prueba', 'WebController@filtros_prueba');
Route::post('/filtros_prueba', 'WebController@filtros_prueba');

Route::get('/register/verify/{code}', 'WebController@verify');

// Cliente fofe Get
Route::get('/login','WebController@login');
Route::get('/register','WebController@register');

// Cliente Login Post
Route::post('/login','WebController@loginAuth');
Route::post('/register','WebController@registerAuth');

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


/*
--------------------------------------  
		Cupones
--------------------------------------
*/
//Canjea el cupon
Route::post('/canjear/{precio}','WebController@canjear');
//Crea el cupon
Route::post('/cupones/crear','CuponesController@store');
//Edita el cupon
Route::post('/cupones/editar/{id}','CuponesController@edit');

//Devuelve todos los cupones
Route::get('/cupones','CuponesController@ShowCupones');
//Devuelve el formulario de creacion de cupones
Route::get('/cupones/crear','CuponesController@create');
//Devuelve el formulario de edicion de cupones
Route::get('/cupones/editar/{id}','CuponesController@editar');
//Elimina un cupon
Route::get('/cupones/eliminar/{id}','CuponesController@eliminar');

/*
--------------------------------
	Articulos - Usuario
--------------------------------
*/
//Retorna la vista de un producto en especifico
Route::post('/ver_mas','WebController@ver_mas');
Route::get('/ver_mas/{id}','WebController@publicacion');

//Retorna los articulos agotados
Route::post('/agotados','WebController@Art_agotados');
Route::get('/agotados','WebController@Art_agotados');

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
	Encuestas - Administracion
------------------------------
*/
//Devuelve todas las encuestas
Route::get('/encuestas','EncuestaController@ShowEncuestas');
//Devuelve el formulario para crear encuestas
Route::get('/encuestas/crear','EncuestaController@create');
//Devuelve el formulario para editar encuestas
Route::get('/encuestas/editar/{id}','EncuestaController@editar');
//Elimina una encuesta
Route::get('/encuestas/eliminar/{id}','EncuestaController@eliminar');
//Guarda una nueva encuesta
Route::post('/encuestas/crear','EncuestaController@store');
Route::post('/encuestas/editar/{id}','EncuestaController@change');
//Votar
Route::post('/encuestas/votar/{id}','EncuestaController@Votar');
//Actualiza la encuesta al votar
Route::get('/encuestas/user/show','EncuestaController@MostrarResultado');
//Activa/Desactiva una encuesta
Route::get('/encuesta/activar/{id}','EncuestaController@ActivarEncuesta');
//Elimina las opciones
Route::get('/encuestas/eliminar/opcion/{id}','EncuestaController@EliminarOpcion');

/*
-------------------------------
	Ofertas - Administración
-------------------------------
*/
//Mostrar las ofertas por revisar
Route::get('/ofertas_cliente','OfertasController@show');
//Mostrar las ofertas aprobadas
Route::get('/ofertas_cliente_aprobadas','OfertasController@show_a');
//Mostrar las ofertas rechazadas
Route::get('/ofertas_cliente_rechazadas','OfertasController@show_r');
//Aprobar oferta
Route::get('/ofertas_cliente/aprobar/{id}','OfertasController@AprobarOferta');
//Rechazar oferta
Route::get('/ofertas_cliente/rechazar/{id}','OfertasController@RechazarOferta');

/*
-------------------------------
	Ofertas - Usuarios
-------------------------------
*/
//Crear oferta
Route::post('/ofertas_cliente/crear','OfertasController@store');
Route::post('/ofertas_cliente','OfertasController@store_oferta');

/*
-------------------------------
		Correo
-------------------------------
*/
Route::get('mailpago','mailController@EnviarPago');

/*
------------------------------
	Miscelaneos
------------------------------
*/

//Articulos sin imagenes
Route::get('/articulosSinImagen','ProgramController@Articulos_Sin_Imagen');

Route::get('/Articulos_sinCategoria','ProgramController@Articulos_sinCategoria');
Route::get('/Articulos_sinPeso','ProgramController@Articulos_sinPeso');

//Agregar imagen
Route::post('/actualizarImagen/{id}','ProgramController@Actualizar_Imagen');

//Articulos sin peso
Route::get('/articulosSinPeso','ProgramController@Articulos_Sin_Peso');

//Agrega el peso
Route::post('/actualizarPeso/{id}','ProgramController@Actualizar_Peso');

//Enlace externo del pago
Route::get('/reporte-pago/{id}','ProgramController@ReportePagoExt');
/*
------------------------------------------
	Pagina 404 - SIEMPRE DEJAR AL FONDO
------------------------------------------
*/

//ESTE SIEMPRE SE DEBE DEJAR DE ULITMO!
Route::get('/{url}', 'WebController@error404');
Route::get('/{url}/{url2}', 'WebController@error404');
Route::get('/{url}/{url2}/{url3}', 'WebController@error404');
