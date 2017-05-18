@extends('layouts.maestra')
@section('title', 'Catalogo')
@section('content')
  <div class="row contenido-catalogo">
    @foreach( $obras as $obra )
    <div class="col s12 m6 l4">
      <div class="card small hoverable sticky-action">
        <div class="card-image">
          @if($obra->vendida)
          <span id="vendida" class="new badge grey darken-3 white-text" data-badge-caption="VENDIDA"></span>
          @endif
          <img class="materialboxed z-depth-1" data-caption="{{ $obra->titulo_obra }}" src="{{ url($obra->imagen) }}">
          @if(Auth::check() && Auth::user()->rol == 'admin')
          <a href="{{ url('catalogo/editar/' . $obra->titulo_obra) }}" class="btn-floating halfway-fab waves-effect waves-light teal" title="editar">
            <i class="material-icons">mode_edit</i>
          </a>
          @endif
        </div>
        <div class="card-content">
          <span class="card-title activator grey-text truncate">{{ $obra->titulo_obra }} <i class="right material-icons">more_vert</i></span>
          <a href="{{ url('catalogo/ver/' . $obra->titulo_obra) }}">Ver detalles</a>

          @if(Auth::check())
          @include('parciales.favorito')
          @endif

        </div>
        <div class="card-reveal white-text">
          <span class="card-title"><i class="material-icons right">close</i></span>
          <span class="flow-text"><h2>{{ $obra->titulo_obra }}</h2>
            <h5>{{ $obra->vendida?'0,00€':$obra->precio.'€' }}</h5></span>
          </div>
        </div>
      </div>
      @endforeach
    </div>    
    @include('parciales.paginacion-obras')
  @endsection