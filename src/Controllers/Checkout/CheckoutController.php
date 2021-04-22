<?php

namespace WoocommerceWeightShipping\Controllers\Checkout;

class CheckoutController
{
    /**
     * Constructor
     */
    public function __construct()
    {
        add_filter('woocommerce_package_rates', [$this, 'updateShippingWeightVariation'], 10, 1);
    }

    /**
     * Convert weight in grams
     *
     * @param float $weight
     * @return int
     */
    public function convertWeightInGrams($weight)
    {
        $unit = get_option('woocommerce_weight_unit');
        $convertedWeight = convertWeightUnitToGrams($weight, $unit);
        return round($convertedWeight, 2);
    }

    /**
     * Get shipping method weight variation
     *
     * @param string $methodId
     * @param int $instanceId
     * @return array|null
     */
    public function getWeightVariation(string $methodId, int $instanceId)
    {
        return unserialize(get_option("woocommerce_{$methodId}_{$instanceId}_weight_variations"));
    }

    /**
     * Update shipping rate depending weight variations on checkout page
     *
     * @param array $rates
     * @return array
     */
    public function updateShippingWeightVariation(array $rates): array
    {
        global $woocommerce;

        $weightVariations = [];
        foreach ($rates as $rate) {
            if ($weightVariation = $this->getWeightVariation($rate->method_id, $rate->instance_id)) {
                $weightVariations[$rate->id] = $weightVariation;
            }
        }

        if (empty($weightVariations)) {
            return $rates;
        }

        $cartWeightInGrams = $this->convertWeightInGrams($woocommerce->cart->cart_contents_weight);

        $shippingMethodWeightVariations = [];
        foreach ($weightVariations as $id => $weightVariation) {
            if ($closestWeightVariation = getClosestWeightVariation($weightVariation, $cartWeightInGrams)) {
                $shippingMethodWeightVariations[$id] = $closestWeightVariation;
            }
        }

        foreach ($shippingMethodWeightVariations as $id => $shippingMethodWeightVariation) {
            $rates[$id]->cost = $shippingMethodWeightVariation['cost'];
        }

        return $rates;
    }
}
