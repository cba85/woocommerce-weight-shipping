<?php

/**
 * Convert a weight unit to grams
 *
 * @param float $weight
 * @param string $woocommerceWeightUnit
 * @return float
 */
function convertWeightUnitToGrams(float $weight, string $unit): float
{
    switch ($unit) {
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

/**
 * Get closest shipping method weight variation
 *
 * @param array $weightVariations
 * @param int $cartWeightInGrams
 * @return array
 */
function getClosestWeightVariation(array $weightVariations, int $cartWeightInGrams)
{
    $closest = null;
    $shippingMethodVariation = null;
    foreach ($weightVariations as $weightVariation) {
        if ($cartWeightInGrams >= $weightVariation['weight']) {
            if (!$closest or abs($cartWeightInGrams - $closest) > abs($weightVariation['weight'] - $cartWeightInGrams)) {
                $closest = $weightVariation['weight'];
                $shippingMethodVariation = $weightVariation;
            }
        }
    }
    return $shippingMethodVariation;
}
