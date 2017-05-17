  <h4 class="col s12 grey-text">
    Información
  </h4>
  {{-- TÍTULO & PRECIO --}}
  <div class="row">
    <div class="input-field col s6">
      <input name="titulo" id="titulo" type="text" value="{{ isset($obra->titulo_obra) ? $obra->titulo_obra : old('titulo') }}">
      <label for="titulo">Título</label>
      <div class="text-danger">{{ $errors->first('titulo') }}</div>
    </div>
    <div class="input-field col s6">
      <input name="precio" id="precio" type="number" min="0" step="any" value="{{ isset($obra->precio) ? $obra->precio : old('precio') }}">
      <label for="precio">Precio</label>
      <div class="text-danger">{{ $errors->first('precio') }}</div>
    </div>
  </div>
  {{-- DESCRIPCION --}}
  <div class="row">
    <div class="input-field col s12">
      <textarea name="descripcion" id="descripcion" class="materialize-textarea validate">{{ isset($obra->descripcion) ? $obra->descripcion : old('descripcion') }}</textarea>
      <label for="descripcion">Descripcion</label>
      <div class="text-danger">{{ $errors->first('descripcion') }}</div>
    </div>
  </div>
  {{-- FOTO --}}
  <div class="row">
    <div class="file-field input-field col s12">
      <div class="btn waves-effect waves-light">
        <span>Foto</span>
        <input type="file" name="foto" >
      </div>
      <div class="file-path-wrapper">
        <input name="ruta_foto" id="file" class="file-path" type="text" placeholder="imagen" value="{{ isset($obra->imagen) ? $obra->imagen : old('foto') }}">
        <div class="text-danger">{{ $errors->first('foto') }}</div>
      </div>
    </div>
  </div>
  {{-- TECNICA & SOPORTE --}}
  <div class="row">
    <div class="input-field col s6">
      <input name="tecnica" id="tecnica" type="text" value="{{ isset($obra->tecnica) ? $obra->tecnica : old('tecnica') }}">
      <label for="tecnica">Técnica</label>
      <div class="text-danger">{{ $errors->first('tecnica') }}</div>
    </div>
    <div class="input-field col s6">
      <input name="soporte" id="soporte" type="text" value="{{ isset($obra->soporte) ? $obra->soporte : old('soporte') }}">
      <label for="soporte">Soporte</label>
      <div class="text-danger">{{ $errors->first('soporte') }}</div>
    </div>
  </div>
  {{-- VENDIDA & ETIQUETAS --}}
  @php
  $vendida = false;
  if(isset($obra->vendida)){
    if($obra->vendida){
      $vendida = true;
    }
  }
  @endphp
  <div class="row">
    <div class="switch col s6">
      <p class="grey-text">Vendida</p>
      <label>
        No
        <input name="vendida" type="checkbox" {{ $vendida ? 'checked disabled':'' }}>
        <span class="lever"></span>
        Si
      </label>
    </div>
    <div class="col s6">
      <p class="grey-text">Etiquetas</p>
      <div class="chips chips-autocomplete"></div>
    </div>
  </div>
  {{-- TAMAÑO --}}
  <h4 class="col s12 grey-text">Medidas (cm) </h4>
  <div class="row">
    <div class="input-field col s6">
      <input name="largo" id="largo" type="number" min="0" step="1" value="{{ isset($obra->largo) ? $obra->largo : old('largo') }}">
      <label for="largo">Largo</label>
      <div class="text-danger">{{ $errors->first('largo') }}</div>
    </div>
    <div class="input-field col s6">
      <input name="alto" id="alto" type="number" min="0" step="1" value="{{ isset($obra->alto) ? $obra->alto : old('alto') }}">
      <label for="alto">Alto</label>
      <div class="text-danger">{{ $errors->first('alto') }}</div>
    </div>
  </div>