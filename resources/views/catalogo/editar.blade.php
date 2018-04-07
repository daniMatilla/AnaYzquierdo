@extends('layouts.maestra')
@section('title', 'Edita&nbsp;obra')
@section('content')
{{-- FORM --}}
<form action="{{ route('editar-obra', ['obra' => $obra->titulo_obra]) }}" method="post" class="col s12" enctype="multipart/form-data">
  {!! csrf_field() !!}
  {{ method_field('PUT') }}
  {{-- Incluimos el cuerpo del fomulario --}}
  @include('parciales.form_nueva_editar')
  {{-- EDITAR --}}
  <div class="row">
    <button id="editar-obra" name="editar-obra" class="btn waves-effect waves-light right" type="submit">Modificar</button>
  </div>
  {{-- FIN FORM --}}
</form>
@endsection