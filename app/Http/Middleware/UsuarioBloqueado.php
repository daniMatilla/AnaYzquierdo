<?php

namespace anayzquierdo\Http\Middleware;
use Auth;
use Closure;

class UsuarioBloqueado {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {
    if (Auth::check() && Auth::user()->bloqueado) {
      Auth::logout();
      return redirect()->route('login')
        ->with('status', 'Hay algun problema con tu cuenta. Ponte en contacto con el administrador');
    }
    return $next($request);
  }
}
