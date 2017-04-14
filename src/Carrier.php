<?php

namespace Argo;

/**
 * Handles carrier interactions.
 */
class Carrier
{
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
        'dhl'   => 'DHL',
        'fedex' => 'FedEx',
        'ups'   => 'UPS',
        'usps'  => 'USPS',
    ];

    /**
     * Initializes the class.
     *
     * @param string $code The carrier code.
     * 
     * @return void
     */
    public function __construct($code)
    {
        if (!array_key_exists($code, self::$carriers)) {
            return false;
        }

        $this->code = $code;
        $this->name = self::$carriers[$code];
    }

    /**
     * Gets the supported carriers.
     *
     * @return array
     */
    public static function getCarriers()
    {
        return self::$carriers;
    }
}
