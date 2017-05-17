<?php

namespace anayzquierdo\Http\Middleware;

use Closure;
use Auth;

class Admin {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {
    if (!Auth::check() || Auth::user()->rol != 'admin') {
      return redirect()->route('home')
        ->with('status', 'No tienes permisos de acceso');
    }
    return $next($request);
  }
}
