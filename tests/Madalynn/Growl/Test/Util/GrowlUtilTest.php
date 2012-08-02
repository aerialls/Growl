<?php

/*
 * This file is part of the Growl library.
 *
 * (c) Julien Brochet <mewt@madalynn.eu>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Madalynn\Growl\Test\Util;

use Madalynn\Growl\Util\GrowlUtil;

class GrowlUtilTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Madalynn\Growl\Util\GrowUtil
     */
    protected $util;

    public function setUp()
    {
        $this->util = new GrowlUtil();
    }
    /**
     * @dataProvider dataDisplayBoolean
     */
    public function testDisplayBoolean($bool, $string)
    {
        $this->assertEquals($string, $this->util->displayBoolean($bool));
    }

    public function dataDisplayBoolean()
    {
        return array(
            array(true, 'true'),
            array(false, 'false'),
            array(null, 'false'),
            array(1, 'true'),
            array(0, 'false'),
            array(15, 'true'),
            array('foo', 'true'),
        );
    }
}