<?php

namespace anayzquierdo\Http\Controllers;
use anayzquierdo\ClasObra;
use anayzquierdo\Etiqueta;
use anayzquierdo\Obra;
use Illuminate\Http\Request;

class EtiquetasController extends Controller {

  public function getEtiquetas(Request $request) {
    if ($request->ajax()) {
      $etiquetas = Etiqueta::RecuperarTodasEtiquetas();
      return response()->json(['todas_etiquetas' => $etiquetas]);
    }
  }

/**
 * Recupera las obra relacionadas por una etiqueta
 */
  public function getObras(Request $request, $nombre_etiqueta) {
    if ($request->ajax()) {
      $etiqueta = Etiqueta::where('nombre_etiqueta', $nombre_etiqueta)->first();
      \Debugbar::info($etiqueta);
      $id_etiqueta = $etiqueta->id_etiqueta;
      \Debugbar::info($id_etiqueta);

      $clas_obras = ClasObra::where('id_etiqueta', $id_etiqueta)->get();
      $id_obras   = [];
      foreach ($clas_obras as $clas_obra) {
        \Debugbar::info($clas_obra->id_obra);
        array_push($id_obras, $clas_obra->id_obra);
      }
      $obras = Obra::whereIn('id_obra', $id_obras)->get();
      return response()->json(['items' => $obras]);
    }
  }
}
