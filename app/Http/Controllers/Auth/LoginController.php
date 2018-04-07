<?php

namespace anayzquierdo\Http\Controllers\Auth;

use anayzquierdo\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;

class LoginController extends Controller {
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
   */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
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
    $this->middleware('guest', ['except' => 'logout']);
  }

  public function login(Request $request) {
    if (Auth::attempt(
      [
        'email'    => $request->email,
        'password' => $request->password,
        'activo'   => true,
      ], $request->has('recordar'))) {
      return redirect()->intended($this->redirectPath())
        ->with('status', 'Bienvenid@ ' . Auth::user()->nombre);
    } else {
      $rules = [
        'email'    => 'required|email|exists:usuarios,email',
        'password' => 'required|exists:usuarios,password',
      ];
      $messages = [
        'email.required'    => 'El campo es requerido',
        'email.email'       => 'El formato de email es incorrecto',
        'email.exists'      => 'El usuario no coincide',
        'password.required' => 'El campo es requerido',
        'password.exists'   => 'El password no coincide',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      return redirect('login')
        ->withErrors($validator)
        ->withInput()
        ->with('status', 'Error al iniciar sesión');
    }
  }
}