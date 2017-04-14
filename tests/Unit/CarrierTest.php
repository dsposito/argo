<?php

namespace Argo\Tests\Unit;

use Argo\Carrier;

class CarrierTest extends \PHPUnit_Framework_TestCase
{
    public function testCarriers()
    {
        foreach (Carrier::getAll() as $code => $name) {
            $carrier = new Carrier($code);

            $this->assertEquals($code, $carrier->code);
            $this->assertEquals($name, $carrier->name);
        }
    }
}
