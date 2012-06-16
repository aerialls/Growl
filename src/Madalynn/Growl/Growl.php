<?php

/*
 * This file is part of the Growl library.
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Madalynn\Growl;

use Madalynn\Growl\Util\GrowlUtil;
use Madalynn\Growl\Notification\Message;
use Madalynn\Growl\Notification\Type;
use Madalynn\Growl\Exception\SocketException;

/**
 * Growl notifier
 */
class Growl
{
    /**
     * The host
     *
     * @var string
     */
    protected $host;

    /**
     * The password
     *
     * @var string
     */
    protected $password;

    /**
     * The connection port
     *
     * @var int
     */
    protected $port;

    /**
     * The application name
     *
     * @var string
     */
    protected $application;

    /**
     * If the notifier is already registered
     *
     * @var Boolean
     */
    protected $registered;

    /**
     * Array of notifications
     *
     * @var array
     */
    protected $notifications;

    /**
     * The Growl util
     *
     * @var Madalynn\Growl\Util\GrowUtil
     */
    private $util;

    /**
     * Constructor
     *
     * @param string $application The name of the application
     * @param string $password    The connection password
     * @param string $host
     * @param int    $port
     */
    public function __construct($application, $password = '', $host = 'localhost', $port = 23053)
    {
        $this->application = $application;
        $this->password = $password;
        $this->host = $host;
        $this->port = $port;
        $this->util = new GrowlUtil();

        $this->registered = false;
    }

    /**
     * Adds a notification
     *
     * @param Type $notification A notification instance
     */
    public function addNotificationType(Type $notification)
    {
        $this->notifications[] = $notification;
    }

    /**
     * Gets all the notification
     *
     * @return array Type
     */
    public function getNotificationTypes()
    {
        return $this->notifications;
    }

    /**
     * Registers the notifier
     *
     * @throws \InvalidArgumentException If no notification is registered
     */
    public function sendRegister()
    {
        if (true === $this->registered) {
            return;
        }

        if (0 === count($this->notifications)) {
            throw new \InvalidArgumentException('You need to add at least one notification type before sending a message.');
        }

        $data = '';
        $this->registered = true;

        $data .= 'Application-Name: '.$this->application."\r\n";
        $data .= 'Notifications-Count: '.count($this->notifications)."\r\n";

        foreach ($this->notifications as $notif) {
            $data .= "\r\n";
            $data .= 'Notification-Name: '.$notif->getName()."\r\n";

            if ($notif->getDisplayName()) {
                $data .= 'Notification-Display-Name: '.$notif->getDisplayName()."\r\n";
            }

            if ($notif->getIcon()) {
                $data .= 'Notification-Icon: '.$notif->getIcon()."\r\n";
            }

            $data .= 'Notification-Enabled: '.$this->util->displayBoolean($notif->isEnabled())."\r\n";
        }

        $this->doSend('REGISTER', $data);
    }

    /**
     *
     * @param Message $message A notification message instance
     */
    public function sendNotify(Message $message)
    {
        if (false === $this->registered) {
            $this->sendRegister();
        }

        $data = '';

        $data .= 'Application-Name: '.$this->application."\r\n";
        $data .= 'Notification-Name: '.$message->getName()."\r\n";
        $data .= 'Notification-Title: '.$message->getTitle()."\r\n";
        $data .= 'Notification-Text: '.$message->getText()."\r\n";
        $data .= 'Notification-Sticky: '.$this->util->displayBoolean($message->isSticky())."\r\n";
        $data .= 'Notification-Priority: '.$message->getPriority()."\r\n";

        if ($message->getId()) {
            $data .= 'Notification-ID: '.$message->getId()."\r\n";
        }

        $this->doSend('NOTIFY', $data);
    }

    /**
     * Sends information into the socket
     *
     * @param array $data
     *
     * @throws SocketException
     */
    protected function doSend($type, $message)
    {
        // Generate data
        $data = 'GNTP/1.0 '.strtoupper($type)." NONE\r\n";
        $data .= $message;

        // A GNTP request must end with <CRLF><CRLF> (two blank lines).
        // This indicates the end of the request to the receiver.
        $data .= "\r\n";

        $socket = @fsockopen('tcp://'.$this->host, $this->port, $errno, $errstr, 30);

        if (false === $socket) {
            throw new SocketException(sprintf('(%s) %s', $errno, $errstr));
        }

        fwrite($socket, $data, strlen($data));
        fclose($socket);
    }
}