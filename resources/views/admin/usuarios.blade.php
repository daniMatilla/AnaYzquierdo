@extends('layouts.maestra')
@section('title', 'Admin. Usuarios')
@section('content')
<div id="modal-alert-eliminar" class="modal">
  <div class="modal-content center-align"></div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
  </div>
</div>
<div class="row">
  <table class="usuarios responsive-table highlight bordered">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Población</th>
        <th>Provincia</th>
        <th>Código postal</th>
        <th>Rol</th>
        <th>Activo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id=tbodyUsuarios>
      @section('cuerpoTabla')      
      @show
    </tbody>
  </table>  
  @include('parciales.paginacion-admin') 
</div>
@endsection