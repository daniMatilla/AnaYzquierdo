@extends('layouts.maestra')
@section('title', 'Nueva&nbsp;obra')
@section('content')
{{-- FORM --}}
<form action="{{ route('nueva-obra') }}" method="post" class="col s12" enctype="multipart/form-data">
  {!! csrf_field() !!}
  {{-- Incluimos el cuerpo del fomulario --}}
  @include('parciales.form_nueva_editar')
  {{-- BOTÓN CREAR --}}
  <div class="row">
    <button id="crear-obra" name="crear" class="btn waves-effect waves-light right" type="submit">Crear</button>
  </div>
</form>
@endsection