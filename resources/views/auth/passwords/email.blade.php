@extends('layouts.maestra')
@section('title', 'Reset password')
@section('content')
@if(Session::has('status'))
<div id="modal-alert" class="modal">
  <div class="modal-content center-align">
    <p>{{Session::get('status')}}</p>
  </div>
  <div class="modal-footer">
    <a class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
  </div>
</div>
@endif
<h1>Resetear el password</h1>

<form method="POST" action="{{url('password/email')}}">
  {!! csrf_field() !!}
  <div class="form-group">
   <label for="email">Email</label>
   <input type="email" class="form-control" name="email" value="{{ old('email') }}" />
   <div class="text-danger">{{$errors->first('email')}}</div>
 </div>
 <button type="submit" class="btn btn-primary">Obtener un enlace para resetear mi password</button>
</form>
@endsection
