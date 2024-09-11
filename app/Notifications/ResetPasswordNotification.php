<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $message;
    public $subject;
    public $fromEmail;
    public $mailer;
    private $otp;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message='use the below code for reset password';
        $this->subject='password resetting';
        $this->fromEmail='test@gmail.com';
        $this->mailer='smtp';
        $this->otp=new Otp();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // $identifier: The identity that will be tied to the OTP.
        // $type: The type of token to be generated, supported types are numeric and alpha_numeric
        // $length (optional | default = 4): The length of token to be generated.
        // $validity (optional | default = 10): The validity period of the OTP in minutes
       
        $otp=$this->otp->generate($notifiable->email, 'numeric', 6, 15);
        // dd($otp);
        return (new MailMessage)
            ->mailer('smtp')
            ->subject($this->subject)
            ->line($this->message)
            ->line("code :".$otp->token);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
