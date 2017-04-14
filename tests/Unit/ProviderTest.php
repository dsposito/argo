<?php

namespace Argo\Tests\Unit;

use Argo\Provider;

class ProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testCarriers()
    {
        foreach (Provider::getAll() as $code => $name) {
            $provider = new Provider($code);

            $this->assertEquals($code, $provider->code);
            $this->assertEquals($name, $provider->name);
        }
    }
}
