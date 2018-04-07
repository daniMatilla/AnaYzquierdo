<?php

namespace anayzquierdo\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Validator;

class ContactoController extends Controller {
  public function getContacto() {
    return view('contacto.contacto');
  }

  public function postContacto(Request $request) {
    $rules = [
      'nombre'     => 'required|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
      'email'      => 'required|email|max:191',
      'comentario' => 'required|max:120',
    ];

    $messages = [
      'nombre.required'     => 'El campo es requerido',
      'nombre.regex'        => 'Sólo se aceptan letras',
      'email.required'      => 'El campo es requerido',
      'email.email'         => 'El formato de email es incorrecto',
      'email.max'           => 'El máximo de caracteres permitidos son 191',
      'comentario.required' => 'El campo es requerido',
      'comentario.max'      => 'El máximo de caracteres permitidos son 120',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      return redirect('contacto')
        ->withErrors($validator)
        ->withInput();
    } else {
      $data['nombre']     = $request->nombre;
      $data['email']      = $request->email;
      $data['comentario'] = $request->comentario;

      // Aquí enviamos el email
      Mail::send('emails.contacto', ['data' => $data], function ($mail) use ($data) {
        $mail->subject('Mensage de ' . $data['nombre']);
        $mail->to(env('MAIL_USERNAME'));
      });

      return redirect()->route('home')
        ->with("status", "El comentario se ha enviado correctamente");
    }
  }
}
