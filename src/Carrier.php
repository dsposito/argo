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
     * OnTrac carrier code.
     */
    const CODE_ONTRAC = 'ontrac';

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
        self::CODE_ONTRAC => 'OnTrac',
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
}
