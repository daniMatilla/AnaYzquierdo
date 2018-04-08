@extends('layouts.maestra')
@section('title', 'Catálogo')
@section('content')
<div class="row contenido-catalogo">
  @foreach( $obras as $obra )
  <div class="col s12 m6 l4">
    @include('parciales.tarjeta_obra')    
  </div>
  @endforeach
</div>    
{{-- @include('parciales.paginacion') --}}
@endsection