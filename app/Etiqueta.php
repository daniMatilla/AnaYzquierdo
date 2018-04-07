<?php

namespace anayzquierdo;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model {
  protected $table      = 'etiquetas';
  protected $primaryKey = 'id_etiqueta';
  protected $fillable   = [
    'nombre_etiqueta'
  ];

  /**
   * Recupera todas las etiquetas
   */
  public function scopeRecuperarTodasEtiquetas($query) {
    return $query->paginate(6);
  }

  /**
   * Recupera las etiquetas de una obra
   */
  public function scopeRecuperarEtiquetasObra($query, $titulo_obra) {
    return $query->where('titulo_obra', $titulo_obra)->get();
  }

  /**
   * Relación de Etiqueta con Obras.
   */
  public function obras() {
    return $this->belongsToMany('anayzquierdo\Obra', 'clas_obras', 'id_etiqueta', 'id_obra')
    ->withPivot('id_etiqueta');
  }
}
