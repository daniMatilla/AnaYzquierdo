@extends('layouts.maestra')
@section('title', 'Admin.&nbsp;Pedidos')
@section('content')
  <div id="modal-alert-estado-pedido" class="modal">
    <div class="modal-content center-align">
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-teal btn-flat">Aceptar</a>
    </div>
  </div>

  <div class="row contenido-admin-pedidos">
    <table id="tabla-admin-pedidos" class="pedidos responsive-table highlight bordered">
      <thead>
      <tr>
        <th>Ver</th>
        <th>ID</th>
        <th>Cliente</th>
        <th>Fecha Alta</th>
        <th>Fecha Cierre</th>
        <th>Envio</th>
        <th>Subtotal</th>
        <th>Total</th>
        <th>Estado</th>
      </tr>
      </thead>
      <tbody id=tbodyPedidos>
      @section('cuerpoTabla')
      @show
      </tbody>
    </table>    
    @include('parciales.paginacion')
  </div>
@endsection