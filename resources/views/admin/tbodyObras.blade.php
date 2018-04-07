@extends('admin.obras')
@section('cuerpoTabla')
@if(count($obras) > 0)
@foreach ($obras as $obra)
<tr>
  <td>{{ $obra->id_obra }}</td>
  <td class="center-align">
    <img class="materialboxed z-depth-1 tooltipped" data-position="right" data-tooltip="Ver a pantalla completa" data-caption="{{ $obra->titulo_obra }}" src="{{ url($obra->imagen) }}" alt="{{ $obra->titulo_obra }}">
  </td>
  <td>{{ $obra->titulo_obra }}</td>
  <td>{{ $obra->tecnica }}</td>
  <td>{{ $obra->soporte }}</td>
  <td>{{ $obra->largo }}</td>
  <td>{{ $obra->alto }}</td>
  <td>{{ $obra->precio }}</td>
  @if($obra->vendida)
  <td>
    <span class="vendida new badge grey darken-3 white-text" data-badge-caption="VENDIDA"></span>
  </td>
  @else
  <td></td>
  @endif
  <td>
   {{--ELIMINAR--}}
   <div class="col s6">
    <a href="#modal-alert-eliminar-{{ $obra->id_obra }}"
     class="teal-text waves-effect waves-light btn-eliminar tooltipped" data-position="right" data-tooltip="Eliminar obra">
     <i class="material-icons">delete_forever</i>
   </a>
   <div id="modal-alert-eliminar-{{ $obra->id_obra }}" class="modal">
    <div class="modal-content center-align">
      <p>¿Realmente deseas eliminar {{ $obra->titulo_obra }}?</p>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-teal btn-flat">Cancelar</a>
      <form action="{{ route('eliminar-obra',['id' => $obra->id_obra]) }}" method="post">
        {!! csrf_field() !!}
        <a id="{{ $obra->id_obra }}" href="#!"
         class="modal-action modal-close waves-effect waves-green btn-flat btn-eliminar-obra">Aceptar</a>
       </form>
     </div>
   </div>
 </div>
 <a href="{{ url('catalogo/editar/' . $obra->titulo_obra) }}" class="teal-text waves-effect waves-light tooltipped" data-position="right" data-tooltip="Editar obra">
  <i class="material-icons">mode_edit</i>
</a>
</td>
</tr>
@endforeach
@else
<tr>
  <td colspan="10" class="center">Nada por aquí</td>
</tr>
@endif
@endsection