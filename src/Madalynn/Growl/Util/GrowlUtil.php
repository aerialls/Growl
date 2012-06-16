<?php

/*
 * This file is part of the Growl library.
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Madalynn\Growl\Util;

class GrowlUtil
{
    /**
     * Displays a boolean
     *
     * @param Boolean $boolean The boolean
     *
     * @return string 'true' if the boolean is true, 'false' otherwise
     */
    public function displayBoolean($boolean)
    {
        return true === $boolean ? 'true' : 'false';
    }
}