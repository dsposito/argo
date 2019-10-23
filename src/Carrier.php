<?php

namespace Argo;

/**
 * Handles carrier interactions.
 */
class Carrier
{
    /**
     * DHL carrier code.
     */
    const CODE_DHL = 'dhl';

    /**
     * FedEx carrier code.
     */
    const CODE_FEDEX = 'fedex';

    /**
     * UPS carrier code.
     */
    const CODE_UPS = 'ups';

    /**
     * USPS carrier code.
     */
    const CODE_USPS = 'usps';

    /**
    * LaserShip carrier code.
    */
    const CODE_LASER_SHIP = 'laser_ship';

    /**
     * Carrier code.
     *
     * @var string
     */
    public $code;

    /**
     * Carrier display name.
     *
     * @var string.
     */
    public $name;

    /**
     * Carrier Tracking URL name.
     *
     * @var string.
     */
    public $tracking_url;

    /**
     * Supported carriers.
     *
     * @var array
     */
    private static $carriers = [
        self::CODE_DHL => 'DHL',
        self::CODE_FEDEX => 'FedEx',
        self::CODE_UPS => 'UPS',
        self::CODE_USPS => 'USPS',
        self::CODE_LASER_SHIP => 'LaserShip',
    ];

    /**
     * Track URL for all carriers.
     *
     * @var array
     */
    private static $carrier_urls = [
        self::CODE_DHL        => 'https://www.dhl.com/en/express/tracking.html?AWB=',
        self::CODE_FEDEX      => 'https://www.fedex.com/fedextrack/?tracknumbers=',
        self::CODE_UPS        => 'http://wwwapps.ups.com/WebTracking/track?loc=en_US&trackNums=',
        self::CODE_USPS       => 'https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=',
        self::CODE_LASER_SHIP => 'https://www.lasership.com/track.php?track_number_input=',
    ];

    /**
     * Initializes the class.
     *
     * @param string $code The carrier code.
     *
     * @return void
     */
    public function __construct(string $code)
    {
        if (!array_key_exists($code, self::$carriers)) {
            return false;
        }

        $this->code = $code;
        $this->name = self::$carriers[$code];
        $this->tracking_url = self::$carrier_urls[$code];
    }

    /**
     * Gets all supported carriers.
     *
     * @return array
     */
    public static function getAll(): array
    {
        return self::$carriers;
    }

    /**
     * Gets all supported carriers.
     *
     * @return array
     */
    public static function buildTrackingUrl($carrier, $tracking) : string
    {
        if (key_exists($carrier, self::$carrier_urls) && $tracking != '')
        {
            return self::$carrier_urls[$carrier] . $tracking;
        }

        return false;
    }
}
