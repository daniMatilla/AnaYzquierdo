@extends('layouts.maestra')
@section('title', 'Admin.&nbsp;Etiquetas')
@section('content')
<div id="modal-alert-estado-etiquetas" class="modal">
  <div class="modal-content center-align">
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-teal btn-flat">Aceptar</a>
  </div>
</div>

<div class="row contenido-admin-etiquetas">
  <table id="tabla-admin-etiquetas" class="pedidos responsive-table highlight bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Etiqueta</th>
        <th>Obras relacionadas</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id=tbodyEtiquetas>
      @section('cuerpoTabla')
      @show
    </tbody>
  </table>
  @include('parciales.paginacion')
</div>
@endsection