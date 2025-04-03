<?php

namespace App\Notifications;

use App\Mail\MembershipExpiredMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MembershipExpiredNotification extends Notification
{
    use Queueable;

    private $membership;

    /**
     * Create a new notification instance.
     */
    public function __construct($membership)
    {
        $this->membership = $membership;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): Mailable
    {
        return (new MembershipExpiredMail($this->membership))->to($notifiable->email);

        // return (new MailMessage)
        //     ->subject('[Codeflix] Time to Renew Your Membership!')
        //     ->greeting('Hi ' . $this->membership->user->name . ',')
        //     ->line('Wow, time flies! Your membership expired on ' . $this->membership->end_date->format('d M Y') . '.')
        //     ->line('Don\'t worry, renewing is super easy! Just click the link below:')
        //     ->action('Renew Now!', url('/renew'))
        //     ->line('Don\'t miss out on the latest episodes and other cool features!')
        //     ->line('If you have any questions or need help, the Codeflix team is ready to assist you.')
        //     ->salutation('Best regards, The Codeflix Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
