<?php

namespace Argo;

/**
 * Handles provider interactions.
 */
class Provider
{
    /**
     * Supported providers.
     */
    private static $providers = [
        'endicia' => 'Endicia',
    ];

    /**
     * Provider code.
     *
     * @var string
     */
    public $code;

    /**
     * Provider display name.
     *
     * @var string.
     */
    public $name;

    /**
     * Initializes the class.
     *
     * @param string $code The provider code.
     *
     * @return void
     */
    public function __construct(string $code)
    {
        $providers = array_merge(self::$providers, Carrier::getCarriers());
        if (!array_key_exists($code, $providers)) {
            return false;
        }

        $this->code = $code;
        $this->name = $providers[$code];
    }

    /**
     * Gets the supported providers.
     *
     * @return array
     */
    public static function getProviders(): array
    {
        return self::$providers;
    }
}
