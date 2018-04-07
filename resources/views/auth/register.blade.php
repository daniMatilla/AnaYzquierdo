@extends('layouts.maestra')
@section('title', 'Registro')
@section('content')

@if(Session::has('message'))
<div id="modal-alert" class="modal">
  <div class="modal-content center-align">
    <p>{{Session::get('message')}}</p>
  </div>
  <div class="modal-footer">
    <a class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
  </div>
</div>
@endif 
<form id="formCrearUsuario" class="col s12 l8 offset-l3" method="POST" action="{{route('registro')}}">
  <h2 class="grey-text">Formulario de registro</h2>
  {!! csrf_field() !!}
  <div class="row">
    <div class="input-field col s12">
      <label for="nombre">Nombre</label>
      <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" />
      <div class="text-danger">{{$errors->first('nombre')}}</div>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" value="{{ old('email') }}" />
      <div class="text-danger">{{$errors->first('email')}}</div>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <label for="password">Password</label>
      <input type="password" name="password" id="password" />
      <div class="text-danger">{{$errors->first('password')}}</div>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <label for="password_confirmation">Confirmar Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation" />
    </div>
  </div>

  <button type="submit" class="waves-effect waves-light btn">Registrarme</button>   
</form>
@endsection
