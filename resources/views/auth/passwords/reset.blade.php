@extends('layouts.maestra')
@section('title', 'Reset password')
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
<h1>Resetear el password</h1>

<form method="POST" action="{{url('password/reset')}}">
  {!! csrf_field() !!}
  <input type="hidden" name="token" value="{{$token}}" />

  <div class="form-group">
   <label for="email">Email:</label>
   <input type="email" class="form-control" name="email" value="{{old('email')}}" />
   <div class="text-danger">{{$errors->first('email')}}</div>
 </div>

 <div class="form-group">
   <label for="password">Password:</label>
   <input type="password" class="form-control" name="password" />
   <div class="text-danger">{{$errors->first('password')}}</div>
 </div>

 <div class="form-group">
   <label for="password_confirmation">Confirmar Password:</label>
   <input type="password" class="form-control" name="password_confirmation" />
 </div>
 <button type="submit" class="btn btn-primary">Resetear Password</button>
</form>
@endsection
