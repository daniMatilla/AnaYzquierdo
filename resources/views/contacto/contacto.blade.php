@extends('layouts.maestra')
@section('title', 'Contacto')
@section('content')
@php
  $admin = anayzquierdo\Usuario::where('rol', 'admin')->first();
@endphp
  <div class="container">
    <div class="card">
      <div class="card-image hoverable">
        <a class="waves-effect waves-teal " href="https://goo.gl/maps/uDPRijUxk6r" target="_blank">
          <img src="{{ url('/images/mapa.png') }}" alt="mapa">
        </a>
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <h5>Contacta conmigo</h5>
          <div class="collection">
            <a class="valign-wrapper collection-item datos-contacto" href="tel:+34{{$admin->telefono}}">
              <i class="icon fab fa-whatsapp fa-sm fa-fw left grey-text"></i>
              {{$admin->telefono}}
            </a>
            <a class="valign-wrapper collection-item datos-contacto" href="mailto:{{$admin->email}}">
              <i class="icon fas fa-at fa-sm fa-fw left grey-text"></i>
              {{$admin->email}}
            </a>
            <a class="valign-wrapper collection-item datos-contacto" href="https://goo.gl/maps/uDPRijUxk6r" target="_blank">
              <i class="icon fas fa-map-marker-alt fa-sm fa-fw left grey-text"></i>
              {{$admin->direccion}} ({{$admin->poblacion}})
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
