<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <!--favicon-->
  <link rel="icon" href="{{ url('favicon.png') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ url('favicon.png') }}" type="image/x-icon">

  <title>A.Yzquierdo - @yield('title')</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{ url('/assets/materialize/css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ url('/css/estilo.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
</head>
<body>
  <noscript class="z-depth-2">
    <h5 class="center">Bienvenido a anayzquierdo.com</h5>
    <p class="center">La página que estás viendo requiere JavaScript para su correcto funcionamiento.</p> 
    <p class="center">Por favor considera el activarlo.</p>
  </noscript>

  @if(Session::has('status'))
  <div id="modal-alert" class="modal">
    <div class="modal-content center-align">
      <p>{{ Session::get('status') }}</p>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-teal btn-flat">Aceptar</a>
    </div>
  </div>
  @endif

  {{-- CABECERA --}}


  <header>
    @if(Request::is('/'))
    @php
    // Aquí selecionamos una imagen aleatoria para mostrar en el parallax
    $obra = anayzquierdo\Obra::inRandomOrder()->first();
    $imagen = $obra->imagen;
    @endphp
    <div class="parallax-container parallax-top section scrollspy valign-wrapper" id="bienvenida">
      <div class="row">
        <div class="col s12 center">
          <h1>
            <img class="responsive-img" src="{{ url('images/logo_yzquierdo_negro.png') }}" alt="Ana Yzquiedo">
            <span class="">Ana Yzquierdo</span>
          </h1>
          @php
          $admin = anayzquierdo\Usuario::where('rol', 'admin')->first();
          \Debugbar::info($admin);
          @endphp
          <h5 class="black-text light">{{ $admin->saludo }}</h5>
          <div class="parallax">
            <img src="{{ url($imagen) }}" alt="{{ $obra->titulo_obra }}">
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
    <div class="section {{ Request::is('/') ? 'z-depth-3' : '' }}">
      <div class="row">
        <div id="@yield('title')" class="contenido col s12 m8 l9 offset-m1 scrollspy">
          @yield('content')
        </div>
        <div class="col hide-on-small-only m3 l2">
          <ul class="sider-pushpin section table-of-contents" id="pushpin">
            <li><a href="{{ url('/#Catálogo') }}">Bienvenida</a></li>
            <li><a href="#@yield('title')">@yield('title')</a></li>
            @if(Request::is('catalogo/editar/*'))
            <li>
              <img id="miniatura" class="responsive-img z-depth-2" src="{{ url($obra->imagen) }}" alt="{{ $obra->titulo_obra }}">
            </li>
            @endif
          </ul>
        </div>
      </div>
    </div>

    {{-- @if(Request::is('/'))
    <div class="parallax-container section scrollspy">
      <div class="parallax">
        <img src="{{ url($imagen) }}" alt="{{ $obra->titulo_obra }}">
      </div>
    </div>
    @endif --}}
  </main>

  {{-- PIE --}}
  @if(!Request::is('contacto'))
  <footer class="page-footer teal darken-2">
    <div class="container">
      <div class="row">
        <div class="col s12 l6">
          <h5 class="white-text"><small>Ayuda a crecer a</small> anayzquierdo.com</h5>
          <p class="grey-text text-lighten-4">Cualquier petición, comentario y/o sugerencia</p>
          <a href="{{ route('contacto') }}" class="btn teal darken-3 waves-effect waves-light">Contacta</a>
        </div>

        {{-- <div class="col s12 l4 offset-l2">
          <div class="divider hide-on-large-only"></div>
          <h5 class="white-text">Links</h5>
        </div> --}}
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        <span class="left">© 2017 Ana Yzquierdo</span>
        <span class="grey-text text-lighten-2 right hide-on-small-only">Hecho por
          <a class="white-text">Daniel Matilla</a>
        </span>
      </div>
    </div>
  </footer>
  @endif

  <!--  Scripts -->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="{{ url('/js/jquery-3.2.1.js') }}"></script>
  <script src="{{ url('/assets/materialize/js/materialize.min.js') }}"></script>
  <script src="{{ url('/js/init.js') }}"></script>

</body>
</html>
