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
 * Growl notification type
 */
class Type
{
    /**
     * The name (type) of the notification being registered
     *
     * @var string
     */
    protected $name;

    /**
     * The name of the notification that is displayed to the
     * user (defaults to the same value as Notification-Name)
     *
     * @var string
     */
    protected $displayName;

    /**
     * Indicates if the notification should be enabled by
     * default (defaults to False)
     *
     * @var Boolean
     */
    protected $enabled;

    /**
     * The default icon to use for notifications of this type
     *
     * @var string
     */
    protected $icon;

    public function __construct($name)
    {
        $this->enabled = true;
        $this->name = $name;
    }

    /**
     * Creates a new message for this notification
     *
     * @param string $title
     * @param type $message
     * @return Message
     */
    public function create($title, $message = '')
    {
        return new Message($this->name, $title, $message);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    public function getDisplayName()
    {
        return $this->displayName;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    public function getIcon()
    {
        return $this->icon;
    }
}