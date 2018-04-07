@extends('admin.pedidos')
@section('cuerpoTabla')
@if(count($pedidos) > 0)
@foreach ($pedidos as $pedido)
<tr>
  <td class="center-align">
    {{-- VER DETALLE --}}
    <form action="{{ route('admin-detalle-pedido',['id' => $pedido->id_pedido]) }}" method="get">
    {!! csrf_field() !!}
    <a id="{{ $pedido->id_usuario }}" href="#!" class="teal-text btn-detalle-pedido waves-effect waves-light tooltipped" data-tooltip="Ver detalle" data-position="right">
      <i class="material-icons">description</i>
    </a>    
    </form>    

    <div id="modal-detalle-pedido-{{ $pedido->id_usuario }}" class="modal">
      <div class="modal-content left-align">
        <h4>Pedido de {{ $pedido->usuario->nombre . " " . $pedido->usuario->apellidos }}</h4>
        <table class="responsive-table highlight bordered">
          <thead>
            <tr>
              <th>Imagen</th>
              <th>Obra</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody id="tbodyDetalle">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-teal btn-flat">Aceptar</a>
      </div>
    </div>
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
      <a id="estado-pedido-{{ $pedido->id_usuario }}" href="#!" class="teal-text btn-estado-pedido waves-effect waves-teal tooltipped" data-tooltip="{{ $pedido->estado != 'a' ? 'abrir' : 'cerrar' }}" data-position="right">
        <i class="material-icons">{{ $pedido->estado != 'a' ? 'lock' : 'lock_open' }}</i>
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