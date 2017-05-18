@extends('admin.pedidos')
@section('cuerpoTabla')
@if(count($pedidos) > 0)
@foreach ($pedidos as $pedido)
<tr>
  <td class="center-align">
    {{-- VER DETALLE --}}
    <form action="{{ route('detalle-pedido',['id' => $pedido->id_pedido]) }}" method="post">
      {!! csrf_field() !!}
      <a id="detalle-pedido-{{ $pedido->id_usuario }}" href="#!" class="teal-text btn-estado-pedido
      waves-effect waves-light">
        <i class="material-icons">description</i>
      </a>
    </form>
  </td>
  <td>{{ $pedido->id_pedido }}</td>
  <td>{{ $pedido->usuario->nombre . " " . $pedido->usuario->apellidos }}</td>
  <td>{{ $pedido->fecha_alta }}</td>
  <td>{{ $pedido->fecha_cierre }}</td>
  <td>{{ $pedido->envio }}</td>
  <td>{{ $pedido->subtotal}}</td>
  <td>{{ $pedido->subtotal + $pedido->envio}}</td>
  <td class="center-align">
    {{-- ESTADO --}}
    <form action="{{ route('estado-pedido',['id' => $pedido->id_pedido]) }}" method="post">
      {!! csrf_field() !!}
      <a id="estado-pedido-{{ $pedido->id_usuario }}" href="#!" class="teal-text btn-estado-pedido waves-effect waves-teal">
        <i class="material-icons">{{ ($pedido->estado != 'a') ? 'lock' : 'lock_open' }}</i>
      </a>
    </form>
  </td>
</tr>
@endforeach
@else
<tr>
  <td colspan="9" class="center">Nada por aquí</td>
</tr>
@endif
@endsection