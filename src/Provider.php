<?php

namespace Argo;

/**
 * Handles provider interactions.
 */
class Provider
{
    /**
     * Endicia provider code.
     */
    const CODE_ENDICIA = 'endicia';

    /**
     * Supported providers.
     */
    private static $providers = [
        self::CODE_ENDICIA => 'Endicia',
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
        $providers = array_merge(self::$providers, Carrier::getAll());
        if (!array_key_exists($code, $providers)) {
            return false;
        }

        $this->code = $code;
        $this->name = $providers[$code];
    }

    /**
     * Gets all supported providers.
     *
     * @return array
     */
    public static function getAll(): array
    {
        return self::$providers;
    }
}
