<?php

class User {
    
    const NOTIFICATION_PREFER_EMAIL = 1;
    const NOTIFICATION_PREFER_SMS = 2;
    const NOTIFICATION_PREFER_WHATSAPP = 3;
    const NOTIFICATION_PREFER_PUSH = 4;

    private string $name = "";
    private string $email = "";
    private int $phone = 0;
    private $notificationPreference = self::NOTIFICATION_PREFER_EMAIL;

    public function __construct(string $name, string $email, int $phone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function setNotificationPreference($preference): void
    {
        $this->notificationPreference = $preference;
    }

    public function getNotificationPreference(): int
    {
        return $this->notificationPreference;
    }
}

interface INotificationHandler 
{
    public function sendNotification(User $user, string $message): void;
}

class EmailSender implements INotificationHandler 
{
    public function sendNotification(User $user, string $message): void 
    {
        // Pretend logic here
    }
}

class SMSSender implements INotificationHandler 
{
    public function sendNotification(User $user, string $message): void 
    {
        // Pretend logic here

    }
}
class WhatsAppSender implements INotificationHandler 
{
    public function sendNotification(User $user, string $message): void 
    {
        // Pretend logic here

    }
}

// This guy job is to send yapping through channel that already defined
class NotificationDispatcher {

    private array $notificationHandlers;

    public function __construct(array $handlers)
    {
        // set the channel
        $this->notificationHandlers = $handlers;
    }

    public function doNotify(User $user, string $message): void 
    {
        // get user preference
        $preference = $user->getNotificationPreference();

        // check if channel is exist to use
        // as preference is int, it doesnt show in the error
        if (! $this->notificationHandlers[$preference]) throw new \Exception("User Notification Preference was Invalid");

        // send the message
        $this->notificationHandlers[$preference]->sendNotification($user, $message);
        
    }

}


?>