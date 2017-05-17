@extends('layouts.maestra')
@section('title', 'Carrito')
@section('content')
<div class="row">
  <a href="{{ route('vaciar-carrito') }}" class="waves-effect waves-light btn right">
    <i class="material-icons right">remove_shopping_cart</i>
    Vaciar carrito
  </a>
  <div class="carrito">
    <table class="responsive-table highlight bordered">
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Obra</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($carrito as $item)
        <tr>
          <td><img class="materialboxed z-depth-1" data-caption="{{ $item->titulo_obra }}" src="{{ url($item->imagen) }}" alt="{{ $item->titulo_obra }}"></td>
          <td><a href="{{ route('ver-obra', $item->titulo_obra) }}">{{ $item->titulo_obra }}</a></td>
          <td>{{ number_format($item->precio,2) }}</td>
          <td>{{ $item->cantidad }}</td>
          <td>{{ number_format($item->precio * $item->cantidad,2) }} €</td>
          <td>
            <a href="{{route('borrar-carrito', $item->titulo_obra) }}" class="btn-falt waves-effect waves-teal black-text">
              <i class="material-icons">delete</i>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <th>Total</th>
          <th>{{ number_format($total,2) }} €</th>
          <td></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <div class="divider"></div>
</div>
<div class="row">  
  <div class="col s6">
    <a href="{{ route('home') }}" class="waves-effect waves-light left btn">
      <i class="material-icons right">add_shopping_cart</i>
      Seguir comprando
    </a>
  </div>
  <div class="col s6">
    <a href="{{ route('detalle-pedido') }}" class="waves-effect waves-light btn right">
      Detalles del pedido
    </a>
  </div>
</div>
@endsection