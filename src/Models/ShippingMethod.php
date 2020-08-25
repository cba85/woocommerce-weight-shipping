<?php

namespace WoocommerceWeightShipping\Models;

class ShippingMethod
{
    /**
     * Instance id
     *
     * @var integer
     */
    public $instanceId;

    /**
     * Zone id
     *
     * @var integer
     */
    public $zoneId;

    /**
     * Zone
     *
     * @var array
     */
    public $zone = [];

    /**
     * Location
     *
     * @var array
     */
    public $location = [];

    /**
     * Enabled
     *
     * @var bool
     */
    public $enabled;

    /**
     * WooCommerce shipping method settings
     *
     * @var array
     */
    public $settings;

    /**
     * Shipping method weight variations
     *
     * @var array
     */
    public $weightVariations;

    /**
     * Get shipping method settings
     *
     * @return array
     */
    public function getSettings()
    {
        return get_option("woocommerce_mondialrelay_shipping_method_{$this->instanceId}_settings");
    }

    /**
     * Get shipping method weight variations
     *
     * @return array
     */
    public function getWeightVariations()
    {
        if (!$weightVariations = get_option("woocommerce_mondialrelay_shipping_method_{$this->instanceId}_weight_variations")) {
            return null;
        }

        $weightVariations = unserialize($weightVariations);

        usort($weightVariations, function ($a, $b) {
            return $a['weight'] <=> $b['weight'];
        });

        return $weightVariations;
    }

    /**
     * Add a weight variation for shipping method
     *
     * @param float $weight
     * @param float $cost
     * @return void
     */
    public function addWeightVariation(float $weight, float $cost)
    {
        $convertedWeight = $this->convertCurrentWeightUnitToGrams($weight);
        $this->weightVariations[] = [
            'weight' => $convertedWeight,
            'cost' => $cost,
        ];
        update_option("woocommerce_mondialrelay_shipping_method_{$this->instanceId}_weight_variations", serialize($this->weightVariations));
    }

    /**
     * Delete a weight variation for shipping method
     *
     * @param float $weight
     * @return void
     */
    function deleteWeightVariation(float $weight)
    {
        foreach ($this->weightVariations as $key => $weightVariation) {
            if ($weightVariation['weight'] == $weight) {
                unset($this->weightVariations[$key]);
            }
        }

        update_option("woocommerce_mondialrelay_shipping_method_{$this->instanceId}_weight_variations", serialize($this->weightVariations));
    }

    /**
     * Convert order weight in Woocommerce current weight unit to grams
     *
     * @param float $weight
     * @return float
     */
    public function convertCurrentWeightUnitToGrams(float $weight)
    {
        switch (get_option('woocommerce_weight_unit')) {
            case 'g':
                return $weight;
                break;
            case 'kg':
                return $weight * 1000;
                break;
            case 'lbs':
                return $weight * 453.59237;
                break;
            case 'oz':
                return $weight * 28.3495;
                break;

            default:
                return $weight;
                break;
        }
    }
}