<?php

namespace anayzquierdo\Http\Controllers;

use anayzquierdo\DetPedido;
use anayzquierdo\Pedido;
use anayzquierdo\Obra;
use Auth;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller {

  private $_api_context;
  const ENVIO = 15;

  public function __construct() {
    // setup PayPal api context
    $paypal_conf        = \Config::get('paypal');
    $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
    $this->_api_context->setConfig($paypal_conf['settings']);
  }

  public function postPago() {
    $payer = new Payer();
    $payer->setPaymentMethod('paypal');
    $items    = array();
    $subtotal = 0;
    $cart     = \Session::get('carrito');
    $currency = 'EUR';

    foreach ($cart as $obra) {
      $item = new Item();
      $item->setName($obra->titulo_obra)
        ->setCurrency($currency)
        ->setDescription($obra->titulo_obra)
        ->setQuantity($obra->cantidad)
        ->setPrice($obra->precio);
      $items[] = $item;
      $subtotal += $obra->cantidad * $obra->precio;
    }

    $item_list = new ItemList();
    $item_list->setItems($items);

    $details = new Details();
    $details->setSubtotal($subtotal)
      ->setShipping(self::ENVIO);

    $total = $subtotal + self::ENVIO;

    $amount = new Amount();
    $amount->setCurrency($currency)
      ->setTotal($total)
      ->setDetails($details);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
      ->setItemList($item_list)
      ->setDescription('Pedido de prueba en anayzquierdo.com');

    $redirect_urls = new RedirectUrls();
    $redirect_urls->setReturnUrl(\URL::route('pago-estado'))
      ->setCancelUrl(\URL::route('pago-estado'));

    $payment = new Payment();
    $payment->setIntent('Sale')
      ->setPayer($payer)
      ->setRedirectUrls($redirect_urls)
      ->setTransactions(array($transaction));

    try {
      $payment->create($this->_api_context);
    } catch (\PayPal\Exception\PPConnectionException $ex) {
      if (\Config::get('app.debug')) {
        echo "Exception: " . $ex->getMessage() . PHP_EOL;
        $err_data = json_decode($ex->getData(), true);
        exit;
      } else {
        die('Ups! Algo salió mal');
      }
    }

    foreach ($payment->getLinks() as $link) {
      if ($link->getRel() == 'approval_url') {
        $redirect_url = $link->getHref();
        break;
      }
    }

    // add payment ID to session
    \Session::put('paypal_payment_id', $payment->getId());

    if (isset($redirect_url)) {
      // redirect to paypal
      return \Redirect::away($redirect_url);
    }

    return \Redirect::route('ver-carrito')
      ->with('status', 'Ups! Error desconocido.');
  }

  public function getPagoEstado() {
    // Get the payment ID before session clear
    $payment_id = \Session::get('paypal_payment_id');

    // clear the session payment ID
    \Session::forget('paypal_payment_id');

    $payerId = Input::get('PayerID');
    $token   = Input::get('token');

    if (empty($payerId) || empty($token)) {
      return \Redirect::route('home')
        ->with('status', 'Hubo un problema al intentar pagar con Paypal');
    }

    $payment = Payment::get($payment_id, $this->_api_context);

    // PaymentExecution object includes information necessary
    // to execute a PayPal account payment.
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = new PaymentExecution();
    $execution->setPayerId(Input::get('PayerID'));

    //Execute the payment
    $result = $payment->execute($execution, $this->_api_context);

    //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
    if ($result->getState() == 'approved') {
      // payment made
      // Registrar el pedido --- ok
      // Registrar el Detalle del pedido  --- ok
      // Eliminar carrito
      // Enviar correo a user
      // Enviar correo a admin
      // Redireccionar

      $this->guardarPedido(\Session::get('carrito'));
      \Session::forget('carrito');
      return \Redirect::route('home')
        ->with('status', 'Compra realizada de forma correcta');
    }
    return \Redirect::route('home')
      ->with('status', 'La compra fue cancelada');
  }

  /**
   * Guardamos el pedido del usuario en la tabla pedidos
   * y cada item del carrito en la tabla det_pedidos
   * @param $cart
   */
  private function guardarPedido($cart) {
    $subtotal = 0;
    foreach ($cart as $item) {
      $subtotal += $item->precio * $item->cantidad;
    }

    $pedido = Pedido::create([
      'subtotal'   => $subtotal,
      'envio'      => self::ENVIO,
      'id_usuario' => Auth::user()->id_usuario,
      'fecha_alta' => date('Y-m-d H:i:s'),
    ]);

    foreach ($cart as $item) {
      $this->guardarDetallePedido($item, $pedido->id_pedido);
    }
  }

  /**
   * Guardamos cada item del carrito en la tabla det_pedidos
   * @param $item, $id_pedido
   */
  private function guardarDetallePedido($item, $id_pedido) {
    DetPedido::create([
      'id_pedido' => $id_pedido,
      'precio'    => $item->precio,
      'cantidad'  => $item->cantidad,
      'id_obra'   => $item->id_obra,
    ]);

    $this->actualizarObra($item->id_obra);
  }

  /**
   * Actualizamos el estado de la obra comprada
   * @param $id_obra
   */
  private function actualizarObra($id_obra) {
    $obra = Obra::find($id_obra);
    $obra->vendida = true;
    $obra->save();
  }
}
