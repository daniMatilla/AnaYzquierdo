<div class="card small hoverable sticky-action">
  <div class="card-image">
    @if($obra->vendida)
    <span class="new badge grey darken-3 white-text vendida-catalogo" data-badge-caption="VENDIDA"></span>
    @endif
    <img class="materialboxed z-depth-1" data-caption="{{ $obra->titulo_obra }}" src="{{ url($obra->imagen) }}" alt="{{ $obra->titulo_obra }}">
    @if(Auth::check() && Auth::user()->rol == 'admin')
    <a id="{{ $obra->titulo_obra }}" href="{{ route('editar-obra', ['titulo_obra' => $obra->titulo_obra]) }}" class="btn-editar-obra btn-floating halfway-fab-catalogo waves-effect waves-light teal tooltipped" data-position="left" data-tooltip="Editar obra" alt="{{ $obra->titulo_obra }}">
      <i class="material-icons">mode_edit</i>
    </a>
    @endif
  </div>
  <div class="card-content">
    <span class="card-title activator grey-text truncate tooltipped" data-position="left" data-tooltip="Info">{{ $obra->titulo_obra }}
    </span>
    <a id="ver-obra-{{ $obra->id_obra }}" href="{{ url('catalogo/ver/' . $obra->titulo_obra) }}" class="tooltipped ver-obra" 
      data-position="left" data-tooltip="Ver obra">
      <i class="material-icons">visibility</i>
    </a>

    @if(Auth::check())
    <div class="right">
      @include('parciales.favorito')
    </div>
    @endif

  </div>
  <div class="card-reveal white-text">
    <span class="card-title"><i class="material-icons right">close</i>
    <span class="center">
      <h3>{{ $obra->titulo_obra }}</h3>
      <h5>{{ $obra->vendida?'0,00€':$obra->precio.'€' }}</h5>
    </span>
  </div>
</div>