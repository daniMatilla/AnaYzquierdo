<?php

namespace anayzquierdo\Http\Controllers\Auth;

use anayzquierdo\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\Request;

class ResetPasswordController extends Controller {
  /*
  |--------------------------------------------------------------------------
  | Password Reset Controller
  |--------------------------------------------------------------------------
  |
  | This controller is responsible for handling password reset requests
  | and uses a simple trait to include this behavior. You're free to
  | explore this trait and override any methods you wish to tweak.
  |
   */

  use ResetsPasswords;

  /**
   * Where to redirect users after resetting their password.
   *
   * @var string
   */
  protected $redirectTo = '/';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('guest');
  }

  /**
   * Get the password reset validation rules.
   *
   * @return array
   */
  protected function rules() {
    return [
      'token'    => 'required',
      'email'    => 'required|email',
      'password' => 'required|confirmed|min:6|max:20',
    ];
  }

  /**
   * Get the password reset validation error messages.
   *
   * @return array
   */
  protected function validationErrorMessages() {
    return [
      'email.required'     => 'El campo es requerido',
      'email.email'        => 'El formato de email es incorrecto',
      'password.required'  => 'El campo es requerido',
      'password.confirmed' => 'Los passwords no coinciden',
      'password.min'       => 'El mínimo de caracteres permitidos son 6',
      'password.max'       => 'El máximo de caracteres permitidos son 20',
    ];
  }

  /**
   * Get the response for a successful password reset.
   *
   * @param  string  $response
   * @return \Illuminate\Http\RedirectResponse
   */
  protected function sendResetResponse($response) {
    return redirect($this->redirectPath())
      ->with('status', 'Password reseteado con exito');
  }
}
