<?php
/***
 * Bridge is a structural design  pattern that lets you split a large 
   class or a set of closely related classes into two separate hierarchies
   abstraction and implementation which can be developed independently of 
   each other.
  * In simple words:
        Bridge pattern allows you to change one part of a system without 
        changing the other part.
  * Image application have a notification system that supports:
        > Email notifications.
        > SMS notifications.
    and need to add different types of notifications:
        > Alert
        > Reminder
    without Bridge pattern, might create separate classes for every
    combination.
        > EmailAlert
        > EmailReminder

        > SMSAlert
        > SMSReminder
               Notification
                    |
            ┌──────┴──────┐
            |             |
          Alert       Reminder
            |             |
            └──────┬──────┘
                   |
           NotificationSender
                   |
              ┌────┴────┐
              |         |
             Email      SMS
    * When should use Bridge Pattern?
        - if have two independent dimensions that need to evolve separately.
        - if want to avoid creating many classes for every combination.
        - if need to switch implementations at runtime.
    * Cons
        1. More classes: need interfaces, abstractiions and concrete
            implementation.
        2. More complexity: The design may be harder to understand for
            beginners.
        3. Over-engineering risk: For a small application with only one 
            notification type and one sender, Bridge may be unnecessary. 
        
 */

// Step 1: Create the implementation interface

interface NotificationSender
{
    public function send(string $message): void;
}

// Step 2: Create the concrete implementations

class EmailSender implements NotificationSender
{
    public function send(string $message): void
    {
        echo "Sending Email: $message \n";
    }
}

class SmsSender implements NotificationSender
{
    public function send(string $message): void
    {
        echo "Sending SMS: $message \n";
    }
}

// Step 3: Create the abstraction
abstract class Notification
{
    protected NotificationSender $sender;

    public function __construct(NotificationSender $sender)
    {
        $this->sender = $sender;
    }

    abstract public function notify(string $message): void;
}

// Step 4: Create concrete notification types
class AlertNotification extends Notification
{
    public function notify(string $message): void
    {
        $this->sender->send("Alert: $message");
    }
}

class ReminderNotification extends Notification
{
    public function notify(string $message): void
    {
        $this->sender->send("Reminder: $message");
    }
}

// Step 5: Use the Bridge Pattern

$emailAlert = new AlertNotification(new EmailSender());
$emailAlert->notify("Server is down.");


echo "\n";

$smsReminder = new ReminderNotification(new SmsSender());
$smsReminder->notify("Meeting at 10 AM.");

// Output
/**
 * Sending Email: ALERT: Server is down.
 * Sending SMS: REMINDER: Meeting at 10 AM.
 */

/***
 * How does it help?
 * Suppose want to send and alert through SMS instead of email.
 * just change the sender 
 * 
 * $alert = new AlertNotification(new SmsSender());
 * $alert->notify("Server is down.");
 * 
 * and don't need to create a new SmsAlert class.
 * Similarly, you can send reminders through email.
 * 
 * $reminder = new ReminderNotification(new EmailSender());
 * $reminder->notify("Meeting at 10 AM.");
 * 
 * That's the main benefit: notification types and delivery methods
 * can change independently.
 */