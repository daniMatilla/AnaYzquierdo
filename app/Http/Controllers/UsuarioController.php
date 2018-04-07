<?php

namespace anayzquierdo\Http\Controllers;
use anayzquierdo\DetPedido;
use anayzquierdo\Favorito;
use anayzquierdo\Obra;
use anayzquierdo\Pedido;
use anayzquierdo\Usuario;
use Auth;
use Illuminate\Http\Request;
use Validator;

class UsuarioController extends Controller {

  private function favoritas() {
    return Favorito::recuperarFavoritasDeUsuario(Auth::user()->id_usuario);
  }

  private function pedidos() {
    return Pedido::recuperarPedidosDeUsuario(Auth::user()->id_usuario);
  }

  public function getUsuario() {
    $obras     = Obra::RecuperarFavoritasDeUsuario(Auth::user()->id_usuario);
    $favoritas = $this->favoritas();
    $pedidos   = $this->pedidos();

    return view('usuario.usuario')
      ->with(['obras' => $obras, 'favoritas' => $favoritas, 'pedidos' => $pedidos]);
  }

  public function putUsuario(Request $request) {
    $rules = [
      'nombre'    => 'required|min:3|max:20|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
      'apellidos' => 'nullable|required|min:3|max:50|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
      'telefono'  => 'nullable|regex:/^\d{3}(-?)\d{3}\1\d{3}$/',
      'direccion' => 'nullable',
      'poblacion' => 'nullable|required_with:direccion',
      'provincia' => 'nullable|required_with:direccion',
      'cp'        => 'nullable|required_with:direccion|regex:/^\d{5}$/',
      'saludo'    => 'nullable|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
    ];

    $messages = [
      'nombre.required'         => 'El campo es requerido',
      'nombre.min'              => 'El mínimo de caracteres permitidos son 3',
      'nombre.max'              => 'El máximo de caracteres permitidos son 20',
      'nombre.regex'            => 'Sólo se aceptan letras',
      'apellidos.required'      => 'El campo es requerido',
      'apellidos.min'           => 'El mínimo de caracteres permitidos son 3',
      'apellidos.max'           => 'El máximo de caracteres permitidos son 50',
      'apellidos.regex'         => 'Sólo se aceptan letras',
      'telefono.regex'          => 'Formato: "ddd-ddd-ddd" o "ddddddddd"',
      'poblacion.required_with' => 'El campo es requerido',
      'provincia.required_with' => 'El campo es requerido',
      'cp.required_with'        => 'El campo es requerido',
      'cp.regex'                => 'Formato: "ddddd"',
      'saludo.regex'            => 'Sólo se aceptan letras',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      return redirect()->route('panel-usuario')
        ->withErrors($validator)
        ->withInput();
    } else {
      $usuario            = Usuario::find(Auth::user()->id_usuario);
      $usuario->nombre    = $request->nombre;
      $usuario->apellidos = $request->apellidos;
      $usuario->telefono  = $request->telefono;
      $usuario->direccion = $request->direccion;
      $usuario->poblacion = $request->poblacion;
      $usuario->provincia = $request->provincia;
      $usuario->cp        = $request->cp;
      $usuario->saludo    = $request->saludo;
      $usuario->save();

      return redirect()->route('panel-usuario')
        ->with("status", "Los datos se han modificado correctamente");
    }
  }

  public function getDetallePedido(Request $request, $id_pedido) {
    if ($request->ajax()) {
      $items = DetPedido::RecuperarDetallePedido($id_pedido);
      return response()->json(['accion' => 'ver_detalle', 'items' => $items]);
    }
  }
}
