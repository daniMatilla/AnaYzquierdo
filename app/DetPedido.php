<?php

namespace anayzquierdo;

use Illuminate\Database\Eloquent\Model;

class DetPedido extends Model {
  protected $table = 'det_pedidos';
  protected $primaryKey = 'id_det_pedido';

  protected $fillable   = [
    'id_pedido', 'precio', 'cantidad', 'id_obra'
  ];

  /**
   * Relación de DetPedidos con Pedidos.
   */
  public function pedido() {
    return $this->belongsTo('anayzquierdo\Pedido', 'id_pedido');
  }

  /**
   * Relación de DetPedidos con Obras.
   */
  public function obra() {
    return $this->belongsTo('anayzquierdo\Obra', 'id_obra');
  }

  /**
   * Recupera las líneas de un pedido
   */
  public function scopeRecuperarDetallePedido($query, $id_pedido) {
    return $query->with('obra')->where('id_pedido', $id_pedido)->get();
  }
}
