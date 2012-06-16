Growl notifier
==============

This library is a _simple_ Growl notifier for PHP5.3

### Installation via Composer

The recommended way to install it is through composer.

```JSON
{
    "require": {
        "madalynn/growl": "dev-master"
    }
}
```

### Example
```php
<?php

$growl = new Madalynn\Growl\Growl('My application');

// Create a new notification type for the application
$notification = new Madalynn\Growl\Notification\Type('Foobar');

$notification->setIcon('http://foobar.com/myicon.png');
$notification->setDisplayName('Foobar notification type');

$growl->addNotificationType($notification);

// Create a new message for this type
$message = $notification->create('Title', 'Message');

$message->setSticky(true);
$message->setPriority(Madalynn\Growl\Notification\Message::PRIORITY_MODERATE);

// Send the message
$growl->sendNotify($message);

```