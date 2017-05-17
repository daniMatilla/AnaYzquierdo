<?php

namespace anayzquierdo;

use Illuminate\Database\Eloquent\Model;
use anayzquierdo\Obra;

class Favorito extends Model {
  protected $primaryKey = 'id_favorito';

  /**
   * Recupera ÍD's de las obras favoritas de un usuario
   */
  public function scopeRecuperarFavoritasDeUsuario($query, $usuario) {
    return $query
      ->where('id_usuario', $usuario)
      ->orderBy('id_obra')
      ->get();
  }
}
