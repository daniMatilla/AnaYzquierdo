@extends('layouts.maestra')
@section('title', 'Mi&nbsp;Perfil')
@section('content')
<div class="row">
  <div class="col s12 teal lighten-5 valign-wrapper">
    <h5>Estos son mis datos</h5>
  </div>
</div>

<div class="row">
  <form id="formEditarUsuario" class="col s12" method="POST"}}">
    {!! csrf_field() !!}
    {{ method_field('PUT') }}
    <div class="row">
      <div class="input-field col l4 s12">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ isset(Auth::user()->nombre) ? Auth::user()->nombre : old('nombre') }}" />
        <div class="text-danger">{{$errors->first('nombre')}}</div>
      </div>

      <div class="input-field col l4 s12">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" value="{{ isset(Auth::user()->apellidos) ? Auth::user()->apellidos : old('apellidos') }}" />
        <div class="text-danger">{{$errors->first('apellidos')}}</div>
      </div>

      <div class="input-field col l4 s12">
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" value="{{ isset(Auth::user()->telefono) ? Auth::user()->telefono : old('telefono') }}" />
        <div class="text-danger">{{$errors->first('telefono')}}</div>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" value="{{ isset(Auth::user()->direccion) ? Auth::user()->direccion : old('direccion') }}" />
        <div class="text-danger">{{$errors->first('direccion')}}</div>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12 l8">
        <label for="poblacion">Población</label>
        <input type="text" name="poblacion" id="poblacion" value="{{ isset(Auth::user()->poblacion) ? Auth::user()->poblacion : old('poblacion') }}" />
        <div class="text-danger">{{$errors->first('poblacion')}}</div>
      </div>

      <div class="input-field col s12 l4">
        <label for="cp">Código postal</label>
        <input type="text" name="cp" id="cp" value="{{ isset(Auth::user()->cp) ? Auth::user()->cp : old('cp') }}" />
        <div class="text-danger">{{$errors->first('cp')}}</div>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" id="provincia" value="{{ isset(Auth::user()->provincia) ? Auth::user()->provincia : old('provincia') }}" />
        <div class="text-danger">{{$errors->first('provincia')}}</div>
      </div>
    </div>

    @if(Auth::user()->rol == 'admin')
    <div class="row">
      <div class="input-field col s12">
        <label for="saludo">Saludo</label>
        <input type="text" name="saludo" id="saludo" value="{{ isset(Auth::user()->saludo) ? Auth::user()->saludo : old('saludo') }}" />
        <div class="text-danger">{{$errors->first('saludo')}}</div>
      </div>
    </div>
    @endif

    <button type="submit" class="col s12 m4 waves-effect waves-light btn right">Modificar</button>
  </form>
</div>

{{-- FAVORITAS --}}
@if(count($obras) > 0)
<div class="row">
  <div class="col s12 teal lighten-5 valign-wrapper">
    <h5>Mis favoritos</h5>
  </div>
</div>
<div class="row">
  @foreach( $obras as $obra )
  <div class="col s12 m6 l4">
    @include('parciales.tarjeta_obra')
  </div>
  @endforeach
</div>
@else
<div class="row">
  <div class="col s12 red lighten-5 valign-wrapper">
    <h5>Aún no tengo favoritos</h5>
  </div>
</div>
@endif

{{-- PEDIDOS --}}
@if(count($pedidos) > 0)
<div class="row">
  <div class="col s12 teal lighten-5 valign-wrapper">
    <h5>Mis pedidos</h5>
  </div>
</div>
<div class="row">
  <table id="tabla-admin-pedidos"  class="pedidos responsive-table highlight bordered">
    <thead>
      <tr>
        <th>Ver detalle</th>
        <th>Fecha</th>
        <th>Envio</th>
        <th>Subtotal</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody id=tbodyPedidos>
      @foreach ($pedidos as $pedido)
      <tr>
        <td>
          {{-- VER DETALLE --}}
          <form action="{{ route('usuario-detalle-pedido',['id' => $pedido->id_pedido]) }}" method="get">
            {!! csrf_field() !!}
            <a id="{{ $pedido->id_usuario }}" href="#!" class="teal-text btn-detalle-pedido waves-effect waves-light">
              <i class="material-icons">description</i>
            </a>    
          </form>    

          <div id="modal-detalle-pedido-{{ $pedido->id_usuario }}" class="modal">
            <div class="modal-content left-align">
              {{-- <h4>Pedido de {{ $pedido->usuario->nombre . " " . $pedido->usuario->apellidos }}</h4> --}}
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
        <td>{{ $pedido->fecha_alta }}</td>
        <td>{{ $pedido->envio }}</td>
        <td>{{ $pedido->subtotal}}</td>
        <td>{{ $pedido->subtotal + $pedido->envio}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@else
<div class="row">
  <div class="col s12 red lighten-5 valign-wrapper">
    <h5>Aún no he comprado nada</h5>
    <img class="emoji" alt="😕" src="https://s0.wp.com/wp-content/mu-plugins/wpcom-smileys/twemoji/2/svg/1f615.svg">
  </div>
</div>
@endif
@endsection