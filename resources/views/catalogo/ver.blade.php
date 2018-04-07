@extends('layouts.maestra')
@section('title', 'Ver&nbsp;obra')
@section('content')
<div class="row">
  <div class="col s12 m6 l4 offset-l3">
    <div class="row">
      <div class="card">
        <img class="imagen-ver-obra responsive-img materialboxed z-depth-2 right" data-caption="{{ $obra->titulo_obra }}" src="{{ url($obra->imagen) }}" alt="{{ $obra->titulo_obra }}">
        @if(Auth::check() && Auth::user()->rol == 'admin')
        <a id="{{ $obra->titulo_obra }}" href="{{ route('editar-obra' ,['obra' => $obra->titulo_obra]) }}" class="btn-editar-obra btn-floating halfway-fab-obra waves-effect waves-light pulse teal tooltipped" data-position="left" data-tooltip="Editar obra">
          <i class="material-icons ">mode_edit</i>
        </a>
        @endif
      </div>
    </div>
  </div>

  <div class="col s6 m6 l4 datos-obra">
    <h5 class="titulo-obra">{{ $obra->titulo_obra }}</h5>
    <p>{{ $obra->tecnica }} sobre {{ $obra->soporte }}</p>
    <p>{{ $obra->largo }} x {{ $obra->alto }} cm</p>
    <p>{{ $obra->vendida ? number_format(0.00,2) : number_format($obra->precio,2)}} €</p>

    @if(!Auth::check() && !$obra->vendida)
    <p>¿La quieres?
      <a href="{{ route('login') }}">Inicia sesión</a> o
      <a href="{{ route('registro') }}">Registrate</a>
    </p>
    @endif

    @if(Auth::check() && !$obra->vendida)
    <div class="row">
      <a class="btn waves-effect waves-light {{ Auth::user()->rol == 'admin' ? 'disabled' : '' }}" href="{{ route('add-carrito', $obra->titulo_obra) }}">La quiero</a>
    </div>
    @endif

    @if ($obra->vendida)
    <div class="row">
      <span id="vendida-obra" class="left new badge grey darken-3 white-text" data-badge-caption="VENDIDA"></span>
    </div>
    @endif

    @if(Auth::check())
    <div class="row">
      @include('parciales.favorito')
    </div>
    @endif

    {{ \Debugbar::info($obra->etiquetas) }}
    @foreach ($obra->etiquetas as $etiqueta)
    <div class="chip">
      {{-- VER OBRAS RELACIONADAS --}}
      <form action="{{ route('obras-realcionadas',['etiqueta' => $etiqueta->nombre_etiqueta]) }}" method="get">
        {!! csrf_field() !!}
        <a id="{{ $etiqueta->nombre_etiqueta }}" href="#!" class="teal-text btn-obras-relacionadas">{{ $etiqueta->nombre_etiqueta }} </a>
      </form>    

      <div id="modal-obras-relacionadas-{{ $etiqueta->nombre_etiqueta }}" class="modal">
        <div class="modal-content left-align">
          <h4>Obras con {{ $etiqueta->nombre_etiqueta }}</h4>
          <div id="imagenes-etiqueta-{{ $etiqueta->nombre_etiqueta }}"></div>     
          
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-action modal-close waves-effect waves-teal btn-flat">Aceptar</a>
        </div>
      </div>

    </div>
    @endforeach
  </div>

</div>
@endsection