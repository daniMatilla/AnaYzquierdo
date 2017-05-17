<div class="row">
  {{-- PAGINACION --}}
  @php
      $currentPage = $usuarios->currentPage(); //Página actual
      $maxPages = $currentPage + 3; //Máxima numeración de páginas
      $firstPage = 1; //Primera página
      $lastPage = $usuarios->lastPage(); //Última página
      $nextPage = $currentPage + 1; //Página siguiente
      $forwardPage = $currentPage - 1; //Página anterior
      @endphp

      <ul class="pagination center">

        <!-- Botón para navegar a la primera página -->
        <li class="{{ ($currentPage == $firstPage) ? 'disabled' : 'waves-effect waves-teal' }}">
          <a href="{{ ($currentPage > 1) ? $usuarios->url($firstPage) : '#!' }}">Primera</a>
        </li>

        <!-- Botón para navegar a la página anterior -->
        <li class="{{ ($currentPage == $firstPage) ? 'disabled' : 'waves-effect waves-teal' }}">
          <a href="{{ ($currentPage > 1) ? $usuarios->url($forwardPage) : '#!' }}">
            <i class="material-icons">chevron_left</i>
          </a>
        </li>

        <!-- Mostrar la numeración de páginas, partiendo de la página actual hasta el máximo definido en $maxPages -->
        @for($x = $currentPage; $x < $maxPages; $x++)
        @if($x <= $lastPage)
        <li class="{{ ($x == $currentPage) ? 'active' : 'waves-effect waves-teal' }}">
          <a href="{{ $usuarios->url($x) }}">{{$x}}</a>
        </li>
        @endif
        @endfor

        <!-- Botón para navegar a la pagina siguiente -->
        <li class="{{ ($currentPage == $lastPage) ? 'disabled' : 'waves-effect waves-teal' }}">
          <a href="{{ ($currentPage < $lastPage) ? $usuarios->url($nextPage) : '#!' }}">
            <i class="material-icons">chevron_right</i>
          </a>
        </li>

        <!-- Botón para navegar a la última página -->
        <li class="{{ ($currentPage == $lastPage) ? 'disabled' : 'waves-effect waves-teal' }}">
          <a href="{{ ($currentPage < $lastPage) ? $usuarios->url($lastPage) : '#!' }}">Última</a>
        </li>
      </ul>
      {{-- FIN PAGINACION --}}
    </div>