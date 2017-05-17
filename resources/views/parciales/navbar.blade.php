<ul class="side-nav" id="nav-mobile">
  <li><a href="{{url('/')}}">Bienvenida</a></li>
  @if(!Request::is('catalogo/nueva') && Auth::check())
    <li {{ Request::is('catalogo/nueva') ? ' class=active' : ''}}>
      <a href="{{url('catalogo/nueva')}}">Nueva obra</a>
    </li>
  @endif
  @if(Auth::check())
    <li><a href="{{url('usuario')}}">Mi prefil</a></li>
    <li><a href="{{url('logout')}}">Salir</a></li>
  @else
    <li><a href="{{url('login')}}">Iniciar sesión</a></li>
  @endif
</ul>

<div class="{{ !Request::is('/') ? 'navbar-fixed' : '' }}">
  <nav class="teal nav-pushpin" id="nav">
    <div class="col s12 m8 l9 offset-m1">
      <div class="nav-wrapper">
        <a id="logo" class="brand-logo" href="{{url('/')}}">
          <img class="responsive-img" src="{{ url('images/Logotipo.svg') }}" alt="Ana Yzquiedo">
          <span class="transparent-text">Ana Yzquierdo</span>
        </a>

        {{-- MENU COLAPSADO --}}
        <a href="#!" data-activates="nav-mobile" class="button-collapse">
          <i class="material-icons">menu</i>
        </a>

        {{-- BARRA DE NAVEGACION --}}
        <ul id="top-nav" class="right hide-on-med-and-down">
          @if(Auth::check())
            @if(!Request::is('catalogo/nueva') && Auth::user()->rol == 'admin')
              <li><a href="{{url('catalogo/nueva')}}">Nueva obra</a></li>
            @endif
            <li><a href="#!" class="dropdown-button"
                   data-activates="dropdown">{{ Auth::user()->nombre }}</a></li>
          @else
            @if(!Request::is('login'))
              <li><a href="{{url('login')}}">Iniciar sesión</a></li>
            @endif
          @endif
        </ul>

        {{-- OPCION DE MENU, DESPLEGABLE --}}
        <ul id="dropdown" class="dropdown-content">
          @if(Auth::check())
            @if(!Request::is('usuario') && Auth::user()->rol != 'admin')
              <li>
                <a href="{{ route('panel-usuario') }}">Mi perfíl
                  <i class="material-icons right">face</i>
                </a>
              </li>
            @endif
            @if(Auth::user()->rol == 'admin')
              <li>
                <a href="{{ route('panel-admin-usuarios') }}">Usuarios
                  <i class="material-icons right">people</i>
                </a>
              </li>
              <li>
                <a href="{{ route('panel-admin-pedidos') }}">Pedidos
                  <i class="material-icons right">view_list</i>
                </a>
              </li>
            @endif
            @if(!Request::is('carrito/ver') && \Session::has('carrito'))
              <li><a href="{{ route('ver-carrito') }}">Mi carrito</a></li>
            @endif
            <li class="divider"></li>
            <li>
              <a href="{{ route('logout') }}">Salir
                <i class="material-icons right">exit_to_app</i>
              </a>
            </li>
          @endif
        </ul>

      </div>
    </div>
  </nav>
</div>