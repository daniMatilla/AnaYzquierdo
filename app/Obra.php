<?php

namespace anayzquierdo;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model {
  protected $table = 'obras';
  protected $primaryKey = 'id_obra';

  /**
   * Recupera todas las obras
   */
  public function scopeRecuperarTodasObras($query) {
    //Paginamos la consulta de 6 en 6
    return $query->paginate(6);
  }

  /**
   * Recupera una obra por su nombre
   * @param $titulo
   */
  public function scopeBuscarObraPorTitulo($query, $titulo) {
    //Con firstOrFail() lanzaríamos una excepcion de pagina no encontrada
    return $query->where('titulo_obra', $titulo)->firstOrFail();
  }

  /**
   * Recupera datos de las obras favoritas de un usuario
   */
  public function scopeRecuperarFavoritasDeUsuario($query, $usuario) {
    $obras = \DB::table('favoritos')->select('id_obra')->where('id_usuario', $usuario);
    return $query
      ->whereIn('id_obra', $obras)
      ->orderBy('id_obra')
      ->get();
  }

  /**
   * Relación de Obras con DetPedidos.
   */
  public function det_pedido() {
    return $this->hasOne('anayzquierdo\DetPedido', 'id_obra');
  }

}
