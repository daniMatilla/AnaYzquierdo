@extends('layouts.maestra')
@section('title', 'Detalle pedido')
@section('content')
<div class="row detalle-pedido">
  <div class="col s12">
    <table class="responsive-table highlight bordered">
      <caption><h3>Detalle del pedido</h3></caption>
      <thead>
        <tr>
          <th>Obra</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($carrito as $item)
        <tr>
          <td>{{ $item->titulo_obra }}</td>
          <td>{{ number_format($item->precio,2) }}</td>
          <td>{{ $item->cantidad }}</td>
          <td>{{ number_format($item->precio * $item->cantidad,2) }} €</td>
        </tr>
        @endforeach
        <tr>
          <td></td>
          <td></td>
          <th>Total</th>
          <th>{{ number_format($total,2) }} €</th>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="datos-envio col s12">
  <h5>Datos de envio</h5>
    <p><strong>Nombre:</strong> {{ Auth::user()->nombre . ' ' . Auth::user()->apellidos }}</p>
    <p><strong>Dirección:</strong> {{ Auth::user()->direccion . ', ' . Auth::user()->poblacion . ', ' . Auth::user()->provincia . ' (' . Auth::user()->cp . ')' }}</p>
    <p><strong>Teléfono:</strong> {{ Auth::user()->telefono }}</p>
  </div>
</div>

<div class="row">
  <div class="col s6">
    <a href="{{ route('ver-carrito') }}" class="waves-effect waves-light left btn">
      <i class="material-icons left">chevron_left</i>
      Atras
    </a>
  </div>
  <div class="col s6">
    <a href="{{ route('pago-paypal') }}" class="waves-effect waves-light btn right">
      Pagar
    </a>
  </div>
</div>
@endsection