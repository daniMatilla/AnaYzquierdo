@extends('admin.usuarios')
@section('cuerpoTabla')
@foreach ($usuarios as $usuario)
<tr>
  <td>{{ $usuario->nombre }}</td>
  <td>{{ $usuario->apellidos }}</td>
  <td>{{ $usuario->email }}</td>
  <td>{{ $usuario->telefono }}</td>
  <td>{{ $usuario->direccion }}</td>
  <td>{{ $usuario->poblacion }}</td>
  <td>{{ $usuario->provincia }}</td>
  <td class="right-align">{{ $usuario->cp }}</td>
  <td>{{ $usuario->rol }}</td>
  <td class="right-align">{{ $usuario->activo ? 'si' : 'no' }}</td>
  <td class="valign-wrapper">
    {{-- BLOQUEAR --}}
    <div class="row">
      <div class="col s6">
        <form action="{{ route('bloquear-usuario',['id' => $usuario->id_usuario]) }}" method="post">
          {!! csrf_field() !!}
          <a id="bloquear-{{ $usuario->id_usuario }}" href="#!" class="teal-text btn-bloquear-usuario waves-effect waves-light">
            <i class="material-icons">{{ $usuario->bloqueado ? 'lock' : 'lock_open' }}</i>
          </a>
        </form>
      </div>

      <div class="col s6">
        <a id="{{ $usuario->id_usuario }}" href="#modal-alert-eliminar-{{ $usuario->id_usuario }}" class="teal-text waves-effect waves-light btn-eliminar">
          <i class="material-icons">delete_forever</i>
        </a>
        <div id="modal-alert-eliminar-{{ $usuario->id_usuario }}" class="modal">
          <div class="modal-content center-align">
            <p>Realmente deseas eliminar a {{ $usuario->nombre }}</p>
          </div>
          <div class="modal-footer">
            <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <form action="{{ route('eliminar-usuario',['id' => $usuario->id_usuario]) }}" method="post">
              {!! csrf_field() !!}
              <a id="{{ $usuario->id_usuario }}" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat btn-eliminar-usuario">Aceptar</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </td>
</tr>
@endforeach
@endsection