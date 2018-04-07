@extends('layouts.maestra')
@section('title', 'Reset&nbsp;password')
@section('content')
@if(Session::has('status'))
<div id="modal-alert" class="modal">
  <div class="modal-content center-align">
    <p>{{Session::get('status')}}</p>
  </div>
  <div class="modal-footer">
    <a class="modal-action modal-close waves-effect waves-teal btn-flat">Aceptar</a>
  </div>
</div>
@endif

<form class="col s12 l8 offset-l3 espaciado-top" method="POST" action="{{url('password/reset')}}">
  {!! csrf_field() !!}
  <input type="hidden" name="token" value="{{$token}}" />

  <div class="input-field col s12">
   <label for="email">Email</label>
   <input id="email" type="email" name="email" value="{{old('email')}}" autofocus/>
   <div class="text-danger">{{$errors->first('email')}}</div>
 </div>

 <div class="input-field col s12">
   <label for="password">Password</label>
   <input id="password" type="password" name="password"/>
   <div class="text-danger">{{$errors->first('password')}}</div>
 </div>

 <div class="input-field col s12">
   <label for="password_confirmation">Confirmar Password</label>
   <input id="password_confirmation" type="password" name="password_confirmation"/>
   <div class="text-danger">{{$errors->first('password')}}</div>
 </div>
 
 <button type="submit" class="btn waves-effect wave-light right">Resetear Password</button>
</form>
@endsection
