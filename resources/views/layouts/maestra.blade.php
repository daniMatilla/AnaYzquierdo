<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Ana Yzquierdo - @yield('title')</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{ url('/assets/materialize/css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ url('/css/estilo.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  @if(Session::has('status'))
  <div id="modal-alert" class="modal">
    <div class="modal-content center-align">
      <p>{{ Session::get('status') }}</p>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
    </div>
  </div>
  @endif

  {{-- CABECERA --}}
  <header>
    @if(Request::is('/'))
    @php
    $total_obras = anayzquierdo\Obra::all()->count();
    $id = rand(1,$total_obras);
    $imagen = anayzquierdo\Obra::find($id)->imagen;
    @endphp
    <div class="parallax-container parallax-top section scrollspy valign-wrapper" id="bienvenida">
      <div class="row">
        <div class="col s12 center">
          <h1 class="black-text text-darken-2">Ana Yzquierdo</h1>
          <h5 class="black-text light">Aquí iría el saludo personalizado</h5>
          <div class="parallax">
            <img src="{{ url($imagen) }}">
          </div>
        </div>
        <i class="arrow medium material-icons">keyboard_arrow_down</i>
      </div>
    </div>        
    <div class="parallax difumina"></div>
    @endif

    @include('parciales.navbar')
  </header>

  {{-- CUERPO --}}
  <main>
    <div class="section {{ Request::is('/') ? ' z-depth-3 ' : '' }}">
      <div class="row">
        <div id="@yield('title')" class="contenido col s12 m8 l9 offset-m1 scrollspy">
          @yield('content')
        </div>
        <div class="col hide-on-small-only m3 l2">
          <ul class="sider-pushpin section table-of-contents" id="pushpin">
            <li><a href="{{ url('/#nav') }}">Bienvenida</a></li>
            <li><a href="#@yield('title')">@yield('title')</a></li>
          </ul>
          @if(Request::is('catalogo/editar/*'))
          <img id="miniatura" class="responsive-img z-depth-2" src="{{ url($obra->imagen) }}">
          @endif
        </div>
      </div>
    </div>

    @if(Request::is('/'))
    <div class="parallax-container section scrollspy" id="bienvenida">
      <div class="parallax">
        <img src="{{ url($imagen) }}">
      </div>
    </div>
    @endif
  </main>

  {{-- PIE --}}
  <footer class="page-footer teal darken-2">
    <div class="footer-copyright">
      <div class="row">
        <div class="col s12">© 2017 Ana Yzquierdo</div>
     </div>
     <div class="row hide-on-small-only ">
      <span class="grey-text text-lighten-2 right">Hecho por
        <a class="white-text" href="#!">Daniel Matilla</a>
      </span>
    </div>
  </div>
</footer>

<!--  Scripts -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="{{ url('/js/jquery-3.2.1.js') }}"></script>
<script src="{{ url('/assets/materialize/js/materialize.min.js') }}"></script>
<script src="{{ url('/js/init.js') }}"></script>

</body>
</html>
