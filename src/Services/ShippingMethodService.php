<?php

namespace WoocommerceWeightShipping\Services;

use WoocommerceWeightShipping\Models\ShippingMethod;

class ShippingMethodService
{
    /**
     * Get shipping method information
     *
     * @param $method
     * @return ShippingMethod
     */
    public function getShippingMethodInformation(\StdClass $method): ShippingMethod
    {
        $shippingMethod = new ShippingMethod();
        $shippingMethod->instanceId = $method->instance_id;
        $shippingMethod->methodId = $method->method_id;
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
    public function getShippingMethodsInformation(array $methods): array
    {
        $shippingMethodsCollection = [];
        foreach ($methods as $method) {
            $shippingMethodsCollection[] = $this->getShippingMethodInformation($method);
        }
        return $shippingMethodsCollection;
    }

    /**
     * Get all shipping methods
     *
     * @return array
     */
    public function all(): array
    {
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}woocommerce_shipping_zone_methods as methods
            LEFT JOIN {$wpdb->prefix}woocommerce_shipping_zones as zones ON methods.zone_id = zones.zone_id
            LEFT JOIN {$wpdb->prefix}woocommerce_shipping_zone_locations as locations ON methods.zone_id = locations.zone_id
            WHERE methods.is_enabled = 1";
        $results = $wpdb->get_results($query);
        return $this->getShippingMethodsInformation($results);
    }

    /**
     * Get a shipping method
     *
     * @param int $instanceId
     * @return ShippingMethod
     */
    public function get(int $instanceId)
    {
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}woocommerce_shipping_zone_methods as methods
            LEFT JOIN {$wpdb->prefix}woocommerce_shipping_zones as zones ON methods.zone_id = zones.zone_id
            LEFT JOIN {$wpdb->prefix}woocommerce_shipping_zone_locations as locations ON methods.zone_id = locations.zone_id
            WHERE methods.instance_id = {$instanceId} AND methods.is_enabled = 1";
        $result = $wpdb->get_row($query);
        return $this->getShippingMethodInformation($result);
    }
}
