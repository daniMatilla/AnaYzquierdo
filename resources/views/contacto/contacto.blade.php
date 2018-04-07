@extends('layouts.maestra')
@section('title', 'Contacto')
@section('content')

<div class="container">
  <h2 class="grey-text">Formulario de contacto</h2>
  <form id="formContacto" class="col s12" method="POST" action="{{route('contacto')}}">
    {!! csrf_field() !!}
    <div class="row">
      <div class="input-field col s12">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ Auth::check() ? Auth::user()->nombre . ' ' . Auth::user()->apellidos : old('nombre') }}" />
        <div class="text-danger">{{$errors->first('nombre')}}</div>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ isset(Auth::user()->email) ? Auth::user()->email : old('email') }}" />
        <div class="text-danger">{{$errors->first('email')}}</div>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <textarea name="comentario" id="comentario" class="materialize-textarea" data-length="120"></textarea>
        <label for="comentario">Comentario</label>
        <div class="text-danger">{{$errors->first('comentario')}}</div>
      </div>
    </div>

    <button type="submit" class="waves-effect waves-light btn">Enviar</button>
  </form>
</div>
@endsection
