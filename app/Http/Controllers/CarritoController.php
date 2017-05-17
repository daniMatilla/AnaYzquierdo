<?php

namespace anayzquierdo\Http\Controllers;
use anayzquierdo\Obra;
use Auth;

class CarritoController extends Controller {

  public function __construct() {
    if (!\Session::has('carrito')) {
      \Session::put('carrito', []);
    }
  }

  // Ver carrito
  public function verCarrito() {
    $carrito = \Session::get('carrito');
    $total   = $this->total();

    if (count($carrito)) {
      return view('carrito.carrito')->with(['carrito' => $carrito, 'total' => $total]);
    } else {
      return redirect('/')->with('status', 'El carrito está vacio');
    }
  }

  // Añadir a acarrito
  public function addCarrito(Obra $obra) {
    $carrito                     = \Session::get('carrito');
    $obra->cantidad              = 1;
    $carrito[$obra->titulo_obra] = $obra;
    \Session::put('carrito', $carrito);

    return redirect()->route('ver-carrito');
  }

  // Borrar de carrito
  public function borrarCarrito(Obra $obra) {
    $carrito = \Session::get('carrito');
    unset($carrito[$obra->titulo_obra]);
    \Session::put('carrito', $carrito);

    return redirect()->route('ver-carrito');
  }

  // Vaciar Carrito
  public function vaciarCarrito() {
    \Session::forget('carrito');

    return redirect()->route('ver-carrito');
  }

  // Total
  public function total() {
    $carrito = \Session::get('carrito');
    $total   = 0;
    foreach ($carrito as $item) {
      $total += $item->precio * $item->cantidad;
    }
    return $total;
  }

  // Datalle de pedido
  public function getDetallePedido() {
    if (\Session::has('carrito')) {
      $carrito = \Session::get('carrito');
      $total   = $this->total();

      \Debugbar::info(Auth::user()->direccion);

      if (Auth::user()->direccion == null) {
        return redirect()->route('panel-usuario')->with('status', 'Necesitamos ciertos datos para enviarte el pedido');
      } else {
        return view('carrito.detallePedido')->with(['carrito' => $carrito, 'total' => $total]);
      }

    } else {
      return redirect()->route('home')->with('status', 'No hay detalle que mostrar');
    }
  }

}
