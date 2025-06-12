<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

include './src/NotificationDispatcher.php';
final class NotificationTest extends TestCase
{
    public function testSendFromEmail(): void
    {
        
        $user = new User("User", "user@bogdan.com", 74361892221);
        
        $mockEmailHandler = $this->createMock(INotificationHandler::class);
        $mockSmsHandler = $this->createMock(INotificationHandler::class);

        $mockEmailHandler->expects($this->once())
                         ->method('sendNotification');
                         
        $mockSmsHandler->expects($this->once())
                       ->method('sendNotification');


        $user->setNotificationPreference(User::NOTIFICATION_PREFER_EMAIL);

        $notifier = new NotificationDispatcher([
            User::NOTIFICATION_PREFER_EMAIL => $mockEmailHandler,
            User::NOTIFICATION_PREFER_SMS => $mockSmsHandler,
        ]);

        $notifier->doNotify($user, "User");

    }
}

