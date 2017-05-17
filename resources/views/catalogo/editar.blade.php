@extends('layouts.maestra')
@section('title', 'Editar obra')
@section('content')
{{-- FORM --}}
<form method="post" class="col s12" enctype="multipart/form-data">
  {!! csrf_field() !!}
  {{ method_field('PUT') }}
  {{-- Incluimos el cuerpo del fomulario --}}
  @include('parciales.form_nueva_editar')
  {{-- EDITAR --}}
  <div class="row">
    <button name="crear" class="btn waves-effect waves-light right" type="submit">Modificar</button>
  </div>
  {{-- FIN FORM --}}
</form>
@endsection