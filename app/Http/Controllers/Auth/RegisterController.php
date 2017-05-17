<?php

namespace anayzquierdo\Http\Controllers\Auth;

use anayzquierdo\Http\Controllers\Controller;
use anayzquierdo\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Mail;
use Validator;

class RegisterController extends Controller {
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
   */

  use RegistersUsers;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('guest');
  }

  public function getRegister() {
    return view('auth.register');
  }

  public function postRegister(Request $request) {
    $rules = [
      'nombre'   => 'required|min:3|max:20|regex:/^[a-záéíóúàèìòùäëïöüñ\s]+$/i',
      'email'    => 'required|email|max:191|unique:usuarios,email',
      'password' => 'required|min:6|max:20|confirmed',
    ];

    $messages = [
      'nombre.required'    => 'El campo es requerido',
      'nombre.min'         => 'El mínimo de caracteres permitidos son 3',
      'nombre.max'         => 'El máximo de caracteres permitidos son 20',
      'nombre.regex'       => 'Sólo se aceptan letras',
      'email.required'     => 'El campo es requerido',
      'email.email'        => 'El formato de email es incorrecto',
      'email.max'          => 'El máximo de caracteres permitidos son 191',
      'email.unique'       => 'El email ya existe',
      'password.required'  => 'El campo es requerido',
      'password.min'       => 'El mínimo de caracteres permitidos son 6',
      'password.max'       => 'El máximo de caracteres permitidos son 20',
      'password.confirmed' => 'Los passwords no coinciden',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      return redirect()->route('registro')
        ->withErrors($validator)
        ->withInput();
    } else {
      $usuario                 = new Usuario;
      $data['nombre']          = $usuario->nombre          = $request->nombre;
      $data['email']           = $usuario->email           = $request->email;
      $usuario->password       = bcrypt($request->password);
      $usuario->remember_token = str_random(100);
      $data['confirm_token']   = $usuario->confirm_token   = str_random(100);
      $usuario->save();

      // Aquí enviamos el mail de confirmación
      Mail::send('emails.register', ['data' => $data], function ($mail) use ($data) {
        $mail->subject('Confirma tu cuenta');
        $mail->to($data['email'], $data['nombre']);
      });

      return redirect()->route('home')
        ->with("status", "Se ha enviado un enlace de confirmación a tu cuenta de correo electrónico");
    }
  }

  public function confirmRegister($email, $confirm_token) {
    $usuario = new Usuario;

    // Buscamos, en la tabla usuarios, el usuario con el email y el confirm_token recibidos por parametro...
    $el_usuario = $usuario->select()->where('email', $email)
      ->where('confirm_token', $confirm_token)->first();

    \Debugbar::info('El usuario:' . $el_usuario);

    // ...si existe alguno, actualizamos sus datos
    if (count($el_usuario) > 0) {
      $activo        = true;
      $confirm_token = str_random(100);
      $usuario->where('email', $email)
        ->update([
          'activo'        => $activo,
          'confirm_token' => $confirm_token,
        ]);
      return redirect()->route('home')
        ->with('status', 'Enhorabuena ' . $el_usuario->nombre . ' ya puedes iniciar sesión');
    } else {
      return redirect()->back();
    }
  }
}
