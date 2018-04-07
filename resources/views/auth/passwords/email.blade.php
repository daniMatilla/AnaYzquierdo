@extends('layouts.maestra')
@section('title', 'Reset&nbsp;password')
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

<form class="col s12 l8 offset-l3 espaciado-top" method="POST" action="{{url('password/email')}}">
  {!! csrf_field() !!}
  <div class="row">
    <div class="input-field col s12">
     <label for="email">Email</label>
     <input id="email" type="email" name="email" class="form-control" value="{{old('email')}}" autofocus/>
     <div class="text-danger">{{$errors->first('email')}}</div>
   </div>
 </div>
 <div class="row">
   <button type="submit" class="btn waves-effect wave-light right">Obtener un enlace para resetear mi password</button>
 </div>
</form>
@endsection
