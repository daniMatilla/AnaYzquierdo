<ul class="side-nav" id="nav-mobile">
  @if(Auth::check())
  <li>
    <div class="userView teal lighten-5">
      <a href="{{ route('panel-usuario') }}"><i class="material-icons teal-text medium">face</i></a>
      <a href="#!"><span class="teal-text name">{{ Auth::user()->nombre }}</span></a>
      <a href="#!"><span class="teal-text email">{{ Auth::user()->email }}</span></a>
    </div>
  </li>
  <li><a href="{{ route('home') }}">Bienvenida</a></li>  
  <li><a href="{{url('usuario')}}">Mi prefil</a></li>
  @if(!Request::is('carrito/ver') && \Session::has('carrito'))
  <li>
    <a href="{{ route('ver-carrito') }}">Mi carrito
      <span class="new badge" data-badge-caption="">{{ count(\Session::get('carrito')) }}</span>
    </a>
  </li>
  @endif
  @if(!Request::is('catalogo/nueva') && Auth::user()->rol == 'admin')
  <li {{ Request::is('catalogo/nueva') ? ' class=active' : ''}}>
    <a href="{{url('catalogo/nueva')}}">Nueva obra</a>
  </li>
  @endif
  @if(Auth::user()->rol == 'admin')
  <li><div class="divider"></div></li>
  <li><a class="subheader">Administración</a></li>
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
  <li>
    <a href="{{ route('panel-admin-obras') }}">Obras
      <i class="material-icons right">collections</i>
    </a>
  </li>
  <li>
    <a href="{{ route('panel-admin-etiquetas') }}">Etiquetas
      <i class="material-icons right">class</i>
    </a>
  </li>
  @endif
  <li><div class="divider"></div></li>
  <li><a href="{{url('logout')}}">Salir</a></li>
  @else
  <li><a href="{{url('login')}}">Iniciar sesión</a></li>
  @endif
</ul>

<div class="{{ !Request::is('/') ? 'navbar-fixed' : '' }}">
  <nav class="teal nav-pushpin" id="nav">
    <div class="col s12 m8 l9 offset-m1">
      <div class="nav-wrapper">
        <a id="logo" class="brand-logo center-align" href="{{url('/')}}">
          <img src="{{ url('images/logo_yzquierdo_blanco.png') }}" alt="Ana Yzquiedo">
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
          <li>
            <a href="#!" class="dropdown-button"
            data-activates="dropdown">{{ Auth::user()->nombre }}</a>            
          </li>
          @else
          @if(!Request::is('login'))
          <li>
           <a href="{{url('login')}}">Iniciar sesión</a>
         </li>
         @endif
         @endif
       </ul>

       {{-- OPCIONES DE MENU, DESPLEGABLE --}}
       <ul id="dropdown" class="dropdown-content">
        @if(Auth::check())
        @if(!Request::is('usuario'))
        <li>
          <a href="{{ route('panel-usuario') }}">Mi perfíl
            <i class="material-icons right">face</i>
          </a>
        </li>
        @endif
        @if(Auth::user()->rol == 'admin')
        <li class="divider"></li>
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
        <li>
          <a href="{{ route('panel-admin-obras') }}">Obras
            <i class="material-icons right">collections</i>
          </a>
        </li>
        <li>
          <a href="{{ route('panel-admin-etiquetas') }}">Etiquetas
            <i class="material-icons right">class</i>
          </a>
        </li>
        @endif
        @if(!Request::is('carrito/ver') && \Session::has('carrito'))
        <li>
          <a href="{{ route('ver-carrito') }}">Mi carrito
            @if(count(\Session::get('carrito')) < 1)
            <i class="material-icons right">shopping_cart</i>
            @else
            <span class="new badge right" data-badge-caption="">{{ count(\Session::get('carrito')) }}</span>
            @endif
          </a>          
        </li>
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