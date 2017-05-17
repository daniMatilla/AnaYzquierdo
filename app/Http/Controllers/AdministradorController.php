<?php

namespace anayzquierdo\Http\Controllers;

use anayzquierdo\Pedido;
use anayzquierdo\Usuario;
use Illuminate\Http\Request;

class AdministradorController extends Controller {
  /* USUARIOS */
  public function getUsuariosAdmin() {
    $usuarios = Usuario::RecuperarTodosUsuarios();
    return view('admin.tbodyUsuarios')->with(['usuarios' => $usuarios]);
  }

  public function bloquearUsuario(Request $request, $id) {
    if ($request->ajax()) {
      \Debugbar::info('Petición ajax para bloquear usuario ' . $id);

      $usuario = Usuario::find($id);
      $bloqueado = $usuario->bloqueado;
      \Debugbar::info($bloqueado);

      if (!$bloqueado) {
        $usuario->bloqueado = true;
        $usuario->save();
        return response()->json(['accion' => 'bloqueado', 'status' => $usuario->nombre . ' bloquead@ correctamente',]);
      } else {
        $usuario->bloqueado = false;
        $usuario->save();
        return response()->json(['accion' => 'desbloqueado', 'status' => $usuario->nombre . ' desbloquead@ correctamente',]);
      }

    }
  }

  public function eliminarUsuario(Request $request, $id) {
    if ($request->ajax()) {
      \Debugbar::info('Petición ajax para eliminar usuario ' . $id);
      // Buscamos el usuario clicado en la tabla...
      $usuario = Usuario::find($id);
      // ...lo borramos
      $usuario->delete();

      // Recuperamos los usuarios restantes...
      $usuarios = Usuario::RecuperarTodosUsuarios();
      // ...y renderizamos de nuevo la vista
      $tabla = \View::make('admin.tbodyUsuarios')->with(['usuarios' => $usuarios]);
      $seccion = $tabla->renderSections();
      \Debugbar::info($seccion);

      // Devolvemos a la petición ajax un json con los datos que nos interesen
      return response()->json(['accion' => 'eliminar', 'tbody' => $seccion['cuerpoTabla'], 'status' => $usuario->nombre . ' eliminad@ correctamente',]);
    }
  }

  /* PEDIDOS */
  public function getPedidosAdmin() {
    $pedidos = Pedido::RecuperarTodosPedidos();
    return view('admin.tbodyPedidos')->with(['pedidos' => $pedidos]);
  }

  public function modificarEstadoPedido(Request $request, $id) {
    if ($request->ajax()) {
      \Debugbar::info('Petición ajax para modificar el estado del pedido ' . $id);

      $pedido = Pedido::find($id);
      $estado = $pedido->estado;
      \Debugbar::info($estado);

      if ($estado == 'a') {
        $pedido->estado = 'c';
        $pedido->fecha_cierre = date('Y-m-d H:i:s');
        $pedido->save();

        $seccion = $this->refrescarPedidos();

        return response()->json(['accion' => 'cerrado', 'tbody' => $seccion['cuerpoTabla'],]);
      } else if ($estado == 'c') {
        $pedido->estado = 'a';
        $pedido->fecha_cierre = null;
        $pedido->save();

        $seccion = $this->refrescarPedidos();

        return response()->json(['accion' => 'abierto', 'tbody' => $seccion['cuerpoTabla'],]);
      }
    }
  }

  public function refrescarPedidos() {
    $pedidos = Pedido::RecuperarTodosPedidos();
    $tabla = \View::make('admin.tbodyPedidos')->with(['pedidos' => $pedidos]);
    return $tabla->renderSections();
  }
}
