@extends('layouts.maestra')
@section('title', 'Nueva obra')
@section('content')
{{-- FORM --}}
<form method="post" class="col s12" enctype="multipart/form-data">
  {!! csrf_field() !!}
  {{-- Incluimos el cuerpo del fomulario --}}
  @include('parciales.form_nueva_editar')
  {{-- BOTÓN CREAR --}}
  <div class="row">
    <button name="crear" class="btn waves-effect waves-light right" type="submit">Crear</button>
  </div>
</form>
{{-- FIN FORM --}}
@endsection