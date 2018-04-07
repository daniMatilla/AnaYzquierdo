@extends('admin.etiquetas')
@section('cuerpoTabla')
@if(count($etiquetas) > 0)
{{ \Debugbar::info($etiquetas) }}
@foreach ($etiquetas as $etiqueta)
<tr>
  <td>{{ $etiqueta->id_etiqueta }}</td>
  <td>{{ $etiqueta->nombre_etiqueta }}</td>
  <td>
    @foreach ($etiqueta->obras as $obra)
    <div class="chip">
      <a class="teal-text" href="{{ route('ver-obra',['titulo_obra' => $obra->titulo_obra]) }}">{{ $obra->titulo_obra }}</a>
    </div>
    @endforeach
  </td>
  <td>
   {{--ELIMINAR--}}
   <div class="col s6">
    <a href="#modal-alert-eliminar-{{ $etiqueta->id_etiqueta }}"
     class="teal-text waves-effect waves-light btn-eliminar tooltipped" data-position="top" data-tooltip="Eliminar obra">
     <i class="material-icons">delete_forever</i>
   </a>
   <div id="modal-alert-eliminar-{{ $etiqueta->id_etiqueta }}" class="modal">
    <div class="modal-content center-align">
      <p>¿Realmente deseas eliminar {{ $etiqueta->nombre_etiqueta }}?</p>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-teal btn-flat">Cancelar</a>
      <form action="{{ route('eliminar-etiqueta',['id' => $etiqueta->id_etiqueta]) }}" method="post">
        {!! csrf_field() !!}
        <a id="{{ $etiqueta->id_etiqueta }}" href="#!"
         class="modal-action modal-close waves-effect waves-green btn-flat btn-eliminar-etiqueta">Aceptar</a>
       </form>
     </div>
   </div>
 </div>
</td>
</tr>
@endforeach
@else
<tr>
  <td colspan="4" class="center">Nada por aquí</td>
</tr>
@endif
@endsection