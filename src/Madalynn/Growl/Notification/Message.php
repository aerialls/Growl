<?php

/*
 * This file is part of the Growl library.
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Madalynn\Growl\Notification;

/**
 * Growl notification message
 */
class Message
{
    const PRIORITY_LOW = -2;
    const PRIORITY_MODERATE = -1;
    const PRIORITY_NORMAL = 0;
    const PRIORITY_HIGH = 1;
    const PRIORITY_EMERGENCY = 2;

    /**
     * The name (type) of the notification (must match a
     * previously registered notification name registered
     * by the application specified in Application-Name)
     *
     * @var string
     */
    protected $name;

    /**
     * A unique ID for the notification. If used, this
     * should be unique for every request, even if the
     * notification is replacing a current notification
     * (see Notification-Coalescing-ID)
     *
     * @var string
     */
    protected $id;

    /**
     * The notification's title
     *
     * @var string
     */
    protected $title;

    /**
     * The notification's text
     *
     * @var type
     */
    protected $text;

    /**
     * Indicates if the notification should remain displayed
     * until dismissed by the user
     *
     * @var Boolean
     */
    protected $sticky;

    /**
     * A higher number indicates a higher priority. This is
     * a display hint for the receiver which may be ignored.
     *
     * @var int
     */
    protected $priority;

    /**
     * Constructor
     *
     * @param string $name    The name of the notification type
     * @param string $title   The title of the notification
     * @param string $message The message of the notification
     */
    public function __construct($name, $title, $text = '')
    {
        $this->name = $name;
        $this->title = $title;
        $this->text = $text;

        $this->sticky = false;
        $this->priority = self::PRIORITY_NORMAL;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function isSticky()
    {
        return $this->sticky;
    }

    public function setSticky($sticky)
    {
        $this->sticky = $sticky;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
}