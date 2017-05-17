@extends('layouts.maestra')
@section('title', 'Inicio Sesión')
@section('content')
<div class="row">
  <form class="col s12 l8 offset-l3 espaciado-top" action="{{url('login')}}" method="post" >
    {!! csrf_field( ) !!}
    <div class="row">
      <div class="input-field col s12">
       <label for="email">Email</label>
       <input id="email" type="email" name="email" class="form-control" value="{{old('email')}}" />
       <div class="text-danger">{{$errors->first('email')}}</div>
     </div>
   </div>
   <div class="row">
     <div class="input-field col s12">
       <label for="password">Password</label>
       <input id="password" type="password" name="password" class="form-control" />
       <div class="text-danger">{{$errors->first('password')}}</div>
     </div>
     <div class="input-field col s12">
       <input name="recordar" type="checkbox" id="recordar"/>
       <label for="recordar">Recordar sesión</label>
     </div>
   </div>
   <div class="row">
     <div class="">
     <button type="submit" class="btn right col m4 s12">Iniciar sesión</button>
     </div>
   </div>
   <div class="row">
    <a class="btn-flat waves-effect waves-teal right s6" href="{{url('registro')}}">Registrarme</a>
    <a class="btn-flat waves-effect waves-teal left s6" href="{{url('password/email')}}">Olvidé mi contraseña</a>
  </div>
</form>
</div>
@endsection