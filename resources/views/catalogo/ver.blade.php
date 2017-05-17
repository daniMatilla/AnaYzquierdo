@extends('layouts.maestra')
@section('title', 'Ver obra')
@section('content')
<div class="row">
  <div class="col s6">
    <div class="card">
      <div class="card-image">
        <img class="responsive-img materialboxed z-depth-2" data-caption="{{ $obra->titulo_obra }}" src="{{ url($obra->imagen) }}" alt="{{ $obra->titulo_obra }}">
        @if(Auth::check() && Auth::user()->rol == 'admin')
        <a href="{{ url('catalogo/editar/' . $obra->titulo_obra) }}" class="btn-floating halfway-fab waves-effect waves-light pulse teal" title="editar">
          <i class="material-icons  ">mode_edit</i>
        </a>
        @endif
      </div>
    </div>
    @if(Auth::check())
    @include('parciales.favorito')
    @endif
  </div>
  <div class="col s6">
    <h5>Técnica: {{ $obra->tecnica }}</h5>
    <h5>Soporte: {{ $obra->soporte }}</h5>
    <p><strong>Medidas: </strong> {{ $obra->largo }} x {{ $obra->alto }} cm</p>
    <p><strong>Precio: </strong> {{ $obra->vendida ? number_format(0.00,2) : number_format($obra->precio,2)}} €</p>
    <p><strong>Estado: </strong> {{ $obra->vendida ? 'Obra vendida' : 'Obra disponible' }}</p>
    @if(!Auth::check())
    <p>¿La quieres?  
      <a href="{{ route('login') }}">Inicia sesión</a> o 
      <a href="{{ route('registro') }}">Registrate</a>
    </p>
    @endif
  @if(Auth::check() && !$obra->vendida)
  <a class="btn waves-effect waves-light" href="{{ route('add-carrito', $obra->titulo_obra) }}">La quiero</a>
  @endif
</div>
</div>
@endsection