<?php

namespace anayzquierdo\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification {
  use Queueable;

  /**
   * The password reset token.
   *
   * @var string
   */
  public $token;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct($token) {
    $this->token = $token;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable) {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable) {
    return (new MailMessage)
      ->subject('Reseteo de password')
      ->line('Alguien nos ha solicitado un restablecimiento de password para tu cuenta.')
      ->line('Si no fuiste tú, puedes borrar este email')
      ->action('Resetear Password', route('password.reset', $this->token));
  }

  /**
   * Get the array representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function toArray($notifiable) {
    return [
      //
    ];
  }
}