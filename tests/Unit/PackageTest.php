<?php

namespace Argo\Tests\Unit;

use Argo\Carrier;
use Argo\Package;
use Argo\Provider;

class PackageTest extends \PHPUnit_Framework_TestCase
{
    public function testPackageCarrierIsDhl()
    {
        $package = Package::instance('5775296940');

        $this->assertEquals(Carrier::CODE_DHL, $package->getCarrierCode());
    }

    public function testPackageCarrierIsFedEx()
    {
        $package = Package::instance('778890188810');

        $this->assertEquals(Carrier::CODE_FEDEX, $package->getCarrierCode());
    }

    public function testPackageCarrierIsUps()
    {
        $package = Package::instance('1Z096R870373999074');

        $this->assertEquals(Carrier::CODE_UPS, $package->getCarrierCode());
    }

    public function testPackageCarrierIsUsps()
    {
        $package = Package::instance('9416509699939860039072');

        $this->assertEquals(Carrier::CODE_USPS, $package->getCarrierCode());
    }

    public function testPackageCarrierIsLaserShip()
    {
        $package = Package::instance('LX45346049');

        $this->assertEquals(Carrier::CODE_LASER_SHIP, $package->getCarrierCode());
    }

    public function testPackageProviderIsEndicia()
    {
        $package = Package::instance('420904019401910898416012364585');

        $this->assertEquals(Provider::CODE_ENDICIA, $package->getProviderCode());
        $this->assertEquals(Carrier::CODE_USPS, $package->getCarrierCode());
    }

    public function testPackageHasFormattedTrackingCode()
    {
        $tracking_code = '9416 5096 9993 9860 0390 72';
        $package = Package::instance($tracking_code);

        $this->assertEquals($tracking_code, $package->getTrackingCode(true));
        $this->assertEquals(str_replace(' ', '', $tracking_code), $package->getTrackingCode());
        $this->assertEquals(Carrier::CODE_USPS, $package->getCarrierCode());
    }

    public function testPackageCarrierIsOnTrac()
    {
        $package = Package::instance('C11954958275942');

        $this->assertEquals(Carrier::CODE_ONTRAC, $package->getCarrierCode());
    }
}
