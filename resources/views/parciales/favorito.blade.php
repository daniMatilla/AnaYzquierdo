@php
// Comprobamos las favoritas
$hayFavorita = false;
if(Auth::user()->activo){
  foreach ($favoritas as $favorita) {
    if($obra->id_obra == $favorita->id_obra && Auth::user()->id_usuario == $favorita->id_usuario){
      $hayFavorita = true;
      break;
    }
  }
}
@endphp
<a id="favorito-{{ $obra->id_obra }}" href="{{ route('favorito') }}" class="btn-favorito tooltipped" data-position="left" data-tooltip="Añadir a favoritos" data-id_obra = "{{ $obra->id_obra }}" data-id_usuario = "{{ Auth::user()->id_usuario }}">
<i class="material-icons teal-text">
  @if($hayFavorita)
  {{ 'favorite' }}
  @else
  {{ 'favorite_border' }}
  @endif
</i>
</a>