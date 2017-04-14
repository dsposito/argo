<?php

namespace Argo;

/**
 * The primary Argo class.
 * Handles package interactions.
 */
class Package
{
    /**
     * Original, provided tracking code.
     *
     * @var string
     */
    public $tracking_code_original;

    /**
     * True tracking code (sans provider prefix/suffix characters).
     *
     * @var string
     */
    public $tracking_code;

    /**
     * Carrier data.
     *
     * @var Argo\Carrier
     */
    public $carrier;

    /**
     * Provider data.
     *
     * @var Argo\Provider
     */
    public $provider;

    /**
     * Creates a package instance based on a tracking code.
     *
     * @param string $tracking_code The package tracking code.
     *
     * @return Argo\Package
     */
    public static function instance(string $tracking_code): Package
    {
        $tracking_code = preg_replace('/[^A-Z0-9]/i', '', $tracking_code);

        $instance = new self();
        $instance->tracking_code_original = $tracking_code;
        $instance->tracking_code          = $tracking_code;

        return $instance->deduceTrackingCode();
    }

    /**
     * Gets this package's carrier code.
     *
     * @return string
     */
    public function getCarrierCode(): string
    {
        if (!$this->carrier instanceof Carrier) {
            return '';
        }

        return $this->carrier->code;
    }
    /**
     * Gets this package's carrier name.
     *
     * @return string
     */
    public function getCarrierName(): string
    {
        if (!$this->carrier instanceof Carrier) {
            return '';
        }

        return $this->carrier->name;
    }

    /**
     * Gets this package's provider code.
     *
     * @return string
     */
    public function getProviderCode(): string
    {
        if (!$this->provider instanceof Provider) {
            return '';
        }

        return $this->provider->code;
    }

    /**
     * Gets this package's provider name.
     *
     * @return string
     */
    public function getProviderName(): string
    {
        if (!$this->provider instanceof Provider) {
            return '';
        }

        return $this->provider->name;
    }

    /**
     * Gets the tracking code.
     *
     * @param bool $return_original Whether or not to return the original or true tracking code.
     *
     * @return string
     */
    public function getTrackingCode(bool $return_original = false): string
    {
        return $return_original ? $this->tracking_code_original : $this->tracking_code;
    }

    /**
     * Determines the package's shipping details based on its tracking code.
     *
     * @return Argo\Package
     */
    private function deduceTrackingCode(): Package
    {
        $tracking_code = $this->tracking_code;
        $carrier_code  = null;
        $provider_code = null;

        if (preg_match('/^[0-9]{2}[0-9]{4}[0-9]{4}$/', $tracking_code, $matches)) {
            $carrier_code = Carrier::CODE_DHL;
        }
        else if (preg_match('/^([0-9]{20})?([0-9]{4}[0-9]{4}[0-9]{4}[0-9]{2})$/', $tracking_code, $matches)) {
            $this->tracking_code = $matches[2];

            $carrier_code = 'fedex';
        }
        else if (preg_match('/^1Z[A-Z0-9]{3}[A-Z0-9]{3}[0-9]{2}[0-9]{4}[0-9]{4}$/i', $tracking_code)) {
            $carrier_code = Carrier::CODE_UPS;
        }
        else if (preg_match('/^[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{2}$/', $tracking_code)) {
            $carrier_code = Carrier::CODE_USPS;
        }
        elseif (preg_match('/^420[0-9]{5}([0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{4}[0-9]{2})$/', $tracking_code, $matches)) {
            $this->tracking_code = $matches[1];

            $carrier_code = Carrier::CODE_USPS;
            $provider_code = Provider::CODE_ENDICIA;
        }

        if (!empty($carrier_code)) {
            $this->carrier  = new Carrier($carrier_code);
            $this->provider = new Provider($provider_code ?: $carrier_code);
        }

        return $this;
    }
}
