<?php

namespace anayzquierdo;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model {
  protected $table = 'pedidos';
  protected $primaryKey = 'id_pedido';
  protected $fillable   = [
    'subtotal', 'envio', 'id_usuario', 'fecha_alta'
  ];

  /**
   * Recupera todos los pedidos
   */
  public function scopeRecuperarTodosPedidos($query) {
    //Paginamos la consulta de 5 en 5
    return $query->orderBy('id_pedido', 'desc')->paginate(5);
  }

  /**
   * Recupera todos los pedidos de un usuario
   */
  public function scopeRecuperarPedidosDeUsuario($query, $id_usuario) {
    //Paginamos la consulta de 5 en 5
    return $query->where('id_usuario', $id_usuario)->paginate(5);
  }

  /**
   * Relación de Pedidos con Usuarios.
   */
  public function usuario() {
    return $this->belongsTo('anayzquierdo\Usuario', 'id_usuario');
  }

  /**
   * Relación de Pedidos con DetPedidos.
   */
  public function det_pedido() {
    return $this->hasMany('anayzquierdo\DetPedido', 'id_pedido');
  }
}
