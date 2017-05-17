<?php

namespace anayzquierdo\Http\Controllers;
use anayzquierdo\Favorito;
use Illuminate\Http\Request;

class FavoritoController extends Controller {

  public function getFavorito(Request $request) {
    \Debugbar::info('Entramos en getFavorito');
    $id_usuario = $request->id_usuario;
    $id_obra    = $request->id_obra;

    try {
      $existe_fav = Favorito::where('id_usuario', $id_usuario)
        ->where('id_obra', $id_obra)
        ->first();

      if (!count($existe_fav)) {
        \Debugbar::info('Insertamos favorito');
        $favorito             = new Favorito();
        $favorito->id_usuario = $id_usuario;
        $favorito->id_obra    = $id_obra;
        $favorito->save();
        return 'add';
      } else {
        \Debugbar::info('Eliminamos favorito: ' . $existe_fav);
        $existe_fav->delete();
        return 'remove';
      }
    } catch (\Exception $e) {
      \Debugbar::error($e->getMessage());
    }
  }
}
