<?php

namespace Imj\test;

use Imj\Filter;
use Imj\YafRequest;

/**
 * Class YafRequestTest
 * @package Imj\test
 */
class YafRequestTest extends \PHPUnit_Framework_TestCase
{
    public function requestTest()
    {
        $request = new YafRequest();
        $foo = $request->get('foo', Filter::STRING_TYPE);
        $bar = $request->post('bar', Filter::INT_TYPE, ['min'=>1]);
        $baz = $request->request('baz', Filter::STRING_TYPE);
        $fbb = $request->cookie('fbb', Filter::STRING_TYPE);
        // ...
    }
}