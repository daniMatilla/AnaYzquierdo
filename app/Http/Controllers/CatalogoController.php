<?php

namespace anayzquierdo\Http\Controllers;
use anayzquierdo\ClasObra;
use anayzquierdo\Etiqueta;
use anayzquierdo\Favorito;
use anayzquierdo\Obra;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class CatalogoController extends Controller {

  private function favoritas() {
    $favoritas = "";
    if (Auth::check()) {
      $favoritas = Favorito::recuperarFavoritasDeUsuario(Auth::user()->id_usuario);
      \Debugbar::info('Recuperamos favoritos de usuario ' . Auth::user()->id_usuario);
      \Debugbar::info('Favorias ' . $favoritas);
    }
    return $favoritas;
  }

  public function getBienvenida() {
    $obras     = Obra::recuperarTodasObras();
    $favoritas = $this->favoritas();

    return view('catalogo.catalogo')->with(['obras' => $obras, 'favoritas' => $favoritas]);
  }

  public function getVer($titulo_obra) {
    $obra      = Obra::buscarObraPorTitulo($titulo_obra);
    $favoritas = $this->favoritas();
    return view('catalogo.ver')->with(['obra' => $obra, 'favoritas' => $favoritas]);
  }

  public function getNueva() {
    return view('catalogo.nueva');
  }

  public function postNueva(Request $request) {

    $validator = $this->validacionDeCamposNueva($request);

    if ($validator->fails()) {
      // Si la validación falla se regresa al formulario mostrando los errores y manteniendo los campos
      return redirect()->back()->withErrors($validator->errors())->withInput();
    } else {
      $obra              = new Obra;
      $obra->titulo_obra = $request->titulo;
      $obra->precio      = $request->precio;

      //Tratamiento de la imagen
      $file             = $request->file('foto');
      $extension        = $file->extension();
      $imagenRenombrada = $request->titulo . '.' . $extension;
      $file->storeAs('images/obras', $imagenRenombrada);

      $obra->imagen  = Storage::disk('obras')->url($imagenRenombrada);
      $obra->tecnica = $request->tecnica;
      $obra->soporte = $request->soporte;
      $obra->largo   = $request->largo;
      $obra->alto    = $request->alto;
      $obra->precio  = $request->precio;
      $obra->vendida = isset($request->vendida) ? true : false;
      $obra->save();

      //Retornamos la vista de la obra creada
      return redirect('catalogo/ver/' . $request->titulo);
    }
  }

  public function getEditar(Request $request, $titulo_obra) {
    $obra            = Obra::buscarObraPorTitulo($titulo_obra);
    $etiquetas_obra  = $obra->etiquetas;
    $todas_etiquetas = Etiqueta::RecuperarTodasEtiquetas();

    if ($request->ajax()) {
      $etiquetas_obra = $etiquetas_obra->map(function ($i, $k) {
        return $i->nombre_etiqueta;
      });
      $todas_etiquetas = $todas_etiquetas->map(function ($i, $k) {
        return $i->nombre_etiqueta;
      });
      return response()->json(['etiquetas' => $etiquetas_obra, 'todas_etiquetas' => $todas_etiquetas]);
    } else {
      return view('catalogo.editar')->with(['obra' => $obra, 'etiquetas' => $etiquetas_obra]);
    }
  }

  /**
   * Añade o elimina etiquetas de la obra editada o creada en la BBDD
   */
  public function postEditarEtiquetas(Request $request, $titulo_obra) {
    $obra = Obra::buscarObraPorTitulo($titulo_obra);

    if ($request->ajax()) {
      $tags = $request->chip;
      foreach ($tags as $tag) {
        \Debugbar::info($tag);
      }

      // Evitamos la inserción duplicada de etiquetas en la BBDD.
      $tags_bbdd = Etiqueta::RecuperarTodasEtiquetas();
      $etiquetas = $tags_bbdd->map(function ($i, $k) {
        return $i->nombre_etiqueta;
      });
      // dd($etiquetas);
      foreach ($tags as $tag) {
        if ($request->accion == 'tag_aniadir') {
          if ($etiquetas->contains($tag)) {
            \Debugbar::info('La etiqueta "' . $tag . '" existe en la BBDD');
            $etiqueta = Etiqueta::where('nombre_etiqueta', $tag)->first();
          } else {
            \Debugbar::info('La etiqueta "' . $tag . '" no existe en la BBDD');
            $etiqueta                  = new Etiqueta();
            $etiqueta->nombre_etiqueta = $tag;
            $etiqueta->save();
          }

          // Compruebo si la relación existe
          $clasObra = ClasObra::where(['id_obra' => $obra->id_obra, 'id_etiqueta' => $etiqueta->id_etiqueta])->first();
          if (count($clasObra) == 0) {
            $clasObra              = new ClasObra();
            $clasObra->id_obra     = $obra->id_obra;
            $clasObra->id_etiqueta = $etiqueta->id_etiqueta;
            $clasObra->save();
          }
          return response()->json(['resultado' => 'tag_aniadida']);
        } else if ($request->accion == 'tag_eliminar') {
          $etiqueta = Etiqueta::where('nombre_etiqueta', $tag)->first();
          $clasObra = ClasObra::where(['id_obra' => $obra->id_obra, 'id_etiqueta' => $etiqueta->id_etiqueta])->first();
          $clasObra->delete();
          return response()->json(['resultado' => 'tag_eliminada']);
        }
      }
    }
  }

  /**
   * Modifica la obra editada
   */
  public function putEditar(Request $request, $titulo_obra) {

    $obra      = Obra::buscarObraPorTitulo($titulo_obra);
    $validator = $this->validacionDeCamposEditar($request);

    // Si la validación falla se regresa al formulario mostrando los errores y manteniendo los campos
    if ($validator->fails()) {
      \Debugbar::info('Algo falla');
      return redirect()->back()->withErrors($validator->errors())->withInput();
      // En caso contrario...
    } else {
      // Si no modificamos la imagen...
      if (!$request->hasFile('foto')) {
        // ...pero si el titulo de la obra...
        if ($request->titulo != $obra->titulo_obra) {
          \Debugbar::info($obra->imagen);
          $imagen           = $obra->imagen;
          $tmp              = explode('.', $imagen);
          $extension        = end($tmp);
          $imagenRenombrada = $request->titulo . '.' . $extension;
          // ...renombramos el archivo asociado...
          Storage::move($imagen, Storage::disk('obras')->url($imagenRenombrada));
          // ...y la ruta almacenada en la bbdd
          $obra->imagen = Storage::disk('obras')->url($imagenRenombrada);
          \Debugbar::info($obra->imagen);
        }
      } else {
        if ($request->titulo != $obra->titulo_obra) {
          \Debugbar::info($obra->imagen);
          $imagen = $obra->imagen;
          Storage::delete($imagen);
        }
        //Tratamiento de la imagen
        $file             = $request->file('foto');
        $extension        = $file->extension();
        $imagenRenombrada = $request->titulo . '.' . $extension;
        $file->storeAs('images/obras', $imagenRenombrada);
        $obra->imagen = Storage::disk('obras')->url($imagenRenombrada);
      }
      $obra->titulo_obra = $request->titulo;
      $obra->precio      = $request->precio;
      $obra->tecnica     = $request->tecnica;
      $obra->soporte     = $request->soporte;
      $obra->largo       = $request->largo;
      $obra->alto        = $request->alto;
      $obra->precio      = $request->precio;
      // $obra->vendida     = $request->has('vendida') ? false : true;
      $obra->vendida     = isset($request->vendida) ? true : false;
      $obra->save();

      //Retornamos la vista de la obra editada
      return redirect()->route('ver-obra', $request->titulo)
        ->with("status", "Los datos se han modificado correctamente");
    }
  }

  public function validacionDeCamposNueva(Request $request) {
    $rules = [
      'titulo'  => 'required|string|min:3|max:50|unique:obras,titulo_obra',
      'precio'  => 'required|numeric|min:0|max:9999',
      'foto'    => 'required|image|max:2048*2048*1|mimes:jpeg,jpg,gif,png',
      'tecnica' => 'required|alpha|max:20',
      'soporte' => 'required|alpha|max:20',
      'largo'   => 'required|numeric|digits_between:1,3|min:1',
      'alto'    => 'required|numeric|digits_between:1,3|min:1',

    ];
    $messages = [
      'titulo.required'      => 'El título es requerido',
      'titulo.min'           => 'El título debe estar entre 3 y 50 caracteres',
      'titulo.max'           => 'El título debe estar entre 3 y 50 caracteres',
      'titulo.string'        => 'Permitida cualquier cadena de caracteres',
      'titulo.unique'        => 'Ya existe una obra con este título',

      'precio.required'      => 'El precio es requerido',
      'precio.numeric'       => 'Sólo números',
      'precio.min'           => 'Números positivos',
      'precio.max'           => 'Hasta 9999',

      'foto.required'        => 'El campo es requerido',
      'foto.max'             => 'Tamaño máximo de archivo 2Mb',
      'foto.mimes'           => 'Extensiones permitidas (jpeg,jpg,gif o png)',

      'tecnica.required'     => 'La técnica es requerida',
      'tecnica.alpha'        => 'Solamente caracteres alfabéticos',
      'tecnica.max'          => 'Hasta 20 caracteres',

      'soporte.required'     => 'El soporte es requerido',
      'soporte.alpha'        => 'Solamente caracteres alfabéticos',
      'soporte.max'          => 'Hasta 20 caracteres',

      'largo.required'       => 'El largo es requerido',
      'largo.numeric'        => 'Solamente números',
      'largo.digits_between' => 'En centímetros',
      'largo.min'            => 'El largo no puede ser nulo',

      'alto.required'        => 'El alto es requerido',
      'alto.numeric'         => 'Solamente números',
      'alto.digits_between'  => 'En centímetros',
      'alto.min'             => 'El alto no puede ser nulo',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    return $validator;
  }

  public function validacionDeCamposEditar(Request $request) {
    $rules = [
      'titulo'  => 'required|string|min:3|max:50',
      'precio'  => 'required|numeric|min:0|max:9999',
      'foto'    => 'image|max:2048*2048*1|mimes:jpeg,jpg,gif,png',
      'tecnica' => 'required|alpha|max:20',
      'soporte' => 'required|alpha|max:20',
      'largo'   => 'required|numeric|digits_between:1,3|min:1',
      'alto'    => 'required|numeric|digits_between:1,3|min:1',

    ];
    $messages = [
      'titulo.required'      => 'El título es requerido',
      'titulo.min'           => 'El título debe estar entre 3 y 50 caracteres',
      'titulo.max'           => 'El título debe estar entre 3 y 50 caracteres',
      'titulo.string'        => 'Permitida cualquier cadena de caracteres',
      'titulo.unique'        => 'Ya existe una obra con este título',

      'precio.required'      => 'El precio es requerido',
      'precio.min'           => 'Números positivos',
      'precio.max'           => 'Hasta 9999',

      'foto.max'             => 'Tamaño máximo de archivo 2Mb',
      'foto.mimes'           => 'Extensiones permitidas (jpeg,jpg,gif o png)',

      'tecnica.required'     => 'La técnica es requerida',
      'tecnica.alpha'        => 'Solamente caracteres alfabéticos',
      'tecnica.max'          => 'Hasta 20 caracteres',

      'soporte.required'     => 'El soporte es requerido',
      'soporte.alpha'        => 'Solamente caracteres alfabéticos',
      'soporte.max'          => 'Hasta 20 caracteres',

      'largo.required'       => 'El largo es requerido',
      'largo.numeric'        => 'Solamente números',
      'largo.digits_between' => 'En centímetros',
      'largo.min'            => 'El largo no puede ser nulo',

      'alto.required'        => 'El alto es requerido',
      'alto.numeric'         => 'Solamente números',
      'alto.digits_between'  => 'En centímetros',
      'alto.min'             => 'El alto no puede ser nulo',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    return $validator;
  }

}
