<?php

namespace Bumsgames\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskCompleted extends Notification
{
    use Queueable;


    protected $titulo;
    protected $data;
    protected $data2 = '';
    /**
     * @var string
     */
    // public $token = 'PS4 PS4 PS4';
    /**
     * Create a new notification instance.
     *
     * @param string $token
     */
    public function __construct($titulo, $data, $data2)
    {
        $this->titulo = $titulo;
        $this->data = $data;
        $this->data2 = $data2;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->line('The introduction to the notification.')
        ->action('Notification Action', url('/'))
        ->line('Thank you for using our application!');
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
            'titulo' => $this->titulo,
            'data' => $this->data,
            'data2' => $this->data2,
        ];
    }
}
