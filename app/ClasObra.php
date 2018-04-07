<?php

namespace anayzquierdo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClasObra extends Model {
  protected $table      = 'clas_obras';
  protected $primaryKey = 'id_clas_obra';
  protected $fillable   = [
    'id_obra', 'id_etiqueta'
  ];

}
