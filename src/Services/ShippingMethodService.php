<?php

namespace WoocommerceWeightShipping\Services;

use WoocommerceWeightShipping\Models\ShippingMethod;

/**
 * Mondial Relay shipping method service
 */
class ShippingMethodService
{
    /**
     * Get shipping method information
     *
     * @param $method
     * @return ShippingMethod
     */
    protected function getShippingMethodInformation($method)
    {
        $shippingMethod = new ShippingMethod();
        $shippingMethod->instanceId = $method->instance_id;
        $shippingMethod->zoneId = $method->zone_id;
        $shippingMethod->enabled = $method->is_enabled;
        $shippingMethod->zone['name'] = $method->zone_name;
        if ($method->location_type == "country") {
            $shippingMethod->location['id'] = $method->location_id;
            $shippingMethod->location['code'] = $method->location_code;
        }
        $shippingMethod->settings = $shippingMethod->getSettings();
        $shippingMethod->weightVariations = $shippingMethod->getWeightVariations();
        return $shippingMethod;
    }

    /**
     * Get shipping methods settings and weight variations
     *
     * @param array $methods
     * @return array
     */
    protected function getShippingMethodsInformation(array $methods)
    {
        $shippingMethodsCollection = [];
        foreach ($methods as $method) {
            $shippingMethodsCollection[] = $this->getShippingMethodInformation($method);
        }
        return $shippingMethodsCollection;
    }

    /**
     * Get all Mondail Relay shipping methods
     *
     * @return array
     */
    public function all()
    {
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}woocommerce_shipping_zone_methods as methods
            LEFT JOIN {$wpdb->prefix}woocommerce_shipping_zones as zones ON methods.zone_id = zones.zone_id
            LEFT JOIN {$wpdb->prefix}woocommerce_shipping_zone_locations as locations ON methods.zone_id = locations.zone_id";
        $results = $wpdb->get_results($query);
        return $this->getShippingMethodsInformation($results);
    }

    /**
     * Get a shipping method
     *
     * @param int $instanceId
     * @return ShippingMethod
     */
    public function get($instanceId)
    {
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}woocommerce_shipping_zone_methods as methods
            LEFT JOIN {$wpdb->prefix}woocommerce_shipping_zones as zones ON methods.zone_id = zones.zone_id
            LEFT JOIN {$wpdb->prefix}woocommerce_shipping_zone_locations as locations ON methods.zone_id = locations.zone_id
            WHERE methods.instance_id = {$instanceId}";
        $result = $wpdb->get_row($query);
        return $this->getShippingMethodInformation($result);
    }
}
