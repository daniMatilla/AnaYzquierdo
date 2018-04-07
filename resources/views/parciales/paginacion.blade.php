<div id="paginacion" class="row">
  {{-- PAGINACION --}}
  @php
  if(isset($usuarios)){
    $items = $usuarios;
  }else if(isset($pedidos)){
    $items = $pedidos;
  }else if(isset($obras)){
    $items = $obras;
  }else if(isset($etiquetas)){
    $items = $etiquetas;
  }
  $currentPage = $items->currentPage(); //Página actual
  $maxPages = $currentPage + 3; //Máxima numeración de páginas
  $firstPage = 1; //Primera página
  $lastPage = $items->lastPage(); //Última página
  $nextPage = $currentPage + 1; //Página siguiente
  $forwardPage = $currentPage - 1; //Página anterior
  @endphp

  <ul class="pagination center">

    <!-- Botón para navegar a la primera página -->
    <li class="{{ ($currentPage == $firstPage) ? 'disabled' : 'waves-effect waves-teal' }}">
      <a href="{{ ($currentPage > 1) ? $items->url($firstPage) : '#!' }}">
        <i class="material-icons">first_page</i>
      </a>
    </li>

    <!-- Botón para navegar a la página anterior -->
    <li class="{{ ($currentPage == $firstPage) ? 'disabled' : 'waves-effect waves-teal' }}">
      <a href="{{ ($currentPage > 1) ? $items->url($forwardPage) : '#!' }}">
        <i class="material-icons">chevron_left</i>
      </a>
    </li>

    <!-- Mostrar la numeración de páginas, partiendo de la página actual hasta el máximo definido en $maxPages -->
    @for($x = $currentPage; $x < $maxPages; $x++)
    @if($x <= $lastPage)
    <li class="{{ ($x == $currentPage) ? 'active' : 'waves-effect waves-teal' }}">
      <a href="{{ $items->url($x) }}">{{$x}}</a>
    </li>
    @endif
    @endfor

    <!-- Botón para navegar a la pagina siguiente -->
    <li class="{{ ($currentPage == $lastPage) ? 'disabled' : 'waves-effect waves-teal' }}">
      <a href="{{ ($currentPage < $lastPage) ? $items->url($nextPage) : '#!' }}">
        <i class="material-icons">chevron_right</i>
      </a>
    </li>

    <!-- Botón para navegar a la última página -->
    <li class="{{ ($currentPage == $lastPage) ? 'disabled' : 'waves-effect waves-teal' }}">
      <a href="{{ ($currentPage < $lastPage) ? $items->url($lastPage) : '#!' }}">
        <i class="material-icons">last_page</i>
      </a>
    </li>
  </ul>
  {{-- FIN PAGINACION --}}
</div>