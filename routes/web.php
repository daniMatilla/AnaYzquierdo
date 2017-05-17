<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/* LOGIN */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

/* LOGOUT */
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

/* BIENVENIDA */
Route::get('/', 'CatalogoController@getBienvenida')->name('home')->middleware('usuarioBloqueado');

/* CATALOGO */
Route::group(['prefix' => 'catalogo/'], function () {
  // Catálogo y bienvenida son la misma página
  Route::get('', 'CatalogoController@getBienvenida');
  // Redirecciones a bienvenida en rutas mal formadas
  Route::get('ver', 'CatalogoController@getBienvenida');
  Route::get('editar', 'CatalogoController@getBienvenida');
  // VER OBRA
  Route::get('ver/{titulo_obra}', 'CatalogoController@getVer')->name('ver-obra');
  // NUEVA OBRA
  Route::get('nueva', 'CatalogoController@getNueva')->middleware('admin');
  Route::post('nueva', 'CatalogoController@postNueva')->middleware('admin');
  // EDITAR OBRA
  Route::get('editar/{titulo_obra}', 'CatalogoController@getEditar')->middleware('admin');
  Route::put('editar/{titulo_obra}', 'CatalogoController@putEditar')->middleware('admin');
});

/* REGISTRO */
Route::get('registro', 'Auth\RegisterController@getRegister')->name('registro');
Route::post('registro', 'Auth\RegisterController@postRegister');

/* RESETEAR CONTRASEÑA */
Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

/* CONFIRMACIÓN DE USUARIO */
Route::get('auth/confirm/email/{email}/confirm_token/{confirm_token}', 'Auth\RegisterController@confirmRegister');

/* FAVORITOS */
Route::get('/favorito', 'FavoritoController@getFavorito')->name('favorito')->middleware('auth');

/* CARRITO */
// EL carrito solo será visible para usuarios registrados [middleware('auth')]
// Devolvemos la instancia de la clase que debe inyectarse en la ruta
Route::bind('obra', function ($titulo) {
  return anayzquierdo\Obra::where('titulo_obra', $titulo)->first();
});

Route::group(['prefix' => 'carrito/'], function () {
  Route::get('ver', 'CarritoController@verCarrito')->name('ver-carrito')->middleware('auth');
  Route::get('add/{obra}', 'CarritoController@addCarrito')->name('add-carrito')->middleware('auth');
  Route::get('borrar/{obra}', 'CarritoController@borrarCarrito')->name('borrar-carrito')->middleware('auth');
  Route::get('vaciar', 'CarritoController@vaciarCarrito')->name('vaciar-carrito')->middleware('auth');
});

Route::get('detalle_pedido', 'CarritoController@getDetallePedido')->name('detalle-pedido')->middleware('auth');

/* PAYPAL */
// Enviamos nuestro pedido a paypal
Route::get('pago', 'PaypalController@postPago')->name('pago-paypal')->middleware('auth');

// Paypal redirecciona a esta ruta
Route::get('pago/estado', 'PaypalController@getPagoEstado')->name('pago-estado');

Auth::routes();

/* PANEL DE USUARIO */
Route::get('usuario', 'UsuarioController@getUsuario')
  ->name('panel-usuario')->middleware('auth');
Route::put('usuario', 'UsuarioController@putUsuario')
  ->name('panel-usuario')->middleware('auth');

/* PANEL DE ADMINISTRACION */
// Administración de usuarios
Route::get('admin-usuarios', 'AdministradorController@getUsuariosAdmin')
  ->name('panel-admin-usuarios')->middleware('admin');
Route::post('bloquear_usuario/{id}', 'AdministradorController@bloquearUsuario')
  ->name('bloquear-usuario')->middleware('admin');
Route::post('eliminar_usuario/{id}', 'AdministradorController@eliminarUsuario')
  ->name('eliminar-usuario')->middleware('admin');

// Administración de pedidos
Route::get('admin-pedidos', 'AdministradorController@getPedidosAdmin')
  ->name('panel-admin-pedidos')->middleware('admin');
Route::post('estado_pedido/{id}', 'AdministradorController@modificarEstadoPedido')
  ->name('estado-pedido')->middleware('admin');
