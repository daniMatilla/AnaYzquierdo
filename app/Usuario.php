<?php

namespace anayzquierdo;

use anayzquierdo\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable {
  use Notifiable;
  protected $table      = 'usuarios';
  protected $primaryKey = 'id_usuario';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'nombre', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * Send the password reset notification.
   *
   * @param  string  $token
   * @return void
   */
  public function sendPasswordResetNotification($token) {
    $this->notify(new ResetPasswordNotification($token));
  }

  /**
   * Recupera todos los usuarios
   */
  public function scopeRecuperarTodosUsuarios($query) {
    //Paginamos la consulta de 5 en 5
    return $query->where('rol', 'cliente')->paginate(5);
  }

  /**
   * Relación de Usuarios con Pedidos.
   */
  public function pedido() {
    return $this->hasMany('anayzquierdo\Pedido');
  }
}
