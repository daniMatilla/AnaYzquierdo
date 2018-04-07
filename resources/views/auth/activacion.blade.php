@extends('layouts.maestra')
@section('title', 'Reenvio&nbsp;email&nbsp;activación')
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
<form class="col s12 l8 offset-l3 espaciado-top" method="POST" action="{{ route('activacion') }}">
  {!! csrf_field() !!}
  <div class="form-group">
   <label for="email">Email</label>
   <input type="email" class="form-control" name="email" value="{{ old('email') }}" />
   <div class="text-danger">{{$errors->first('email')}}</div>
 </div>
 <button type="submit" class="btn btn-primary">Obtener un enlace para activar mi cuenta</button>
</form>
@endsection
