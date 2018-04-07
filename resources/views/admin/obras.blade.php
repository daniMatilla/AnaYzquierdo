@extends('layouts.maestra')
@section('title', 'Admin.&nbsp;Obras')
@section('content')
<div id="modal-alert-estado-obras" class="modal">
  <div class="modal-content center-align">
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-teal btn-flat">Aceptar</a>
  </div>
</div>

<div class="row contenido-admin-obras">
  <table id="tabla-admin-obras" class="pedidos responsive-table highlight bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Imagen</th>
        <th>Título</th>
        <th>Técnica</th>
        <th>Soporte</th>
        <th>Largo</th>
        <th>Alto</th>
        <th>Precio</th>
        <th>Vendida</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id=tbodyObras>
      @section('cuerpoTabla')
      @show
    </tbody>
  </table>
  @include('parciales.paginacion')
</div>
@endsection