<?php

use WoocommerceWeightShipping\Services\ShippingMethodService;
use WoocommerceWeightShipping\Models\ShippingMethod;

class ShippingMethodServiceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Get shipping method information using a correct shipping method parameter
     *
     * @return void
     */
    public function testGetShippingMethodInformation()
    {
        $shippingMethod = new \stdClass;
        $shippingMethod->zone_id = 1;
        $shippingMethod->instance_id = 3;
        $shippingMethod->method_id = 'flat_rate';
        $shippingMethod->method_order = 2;
        $shippingMethod->is_enabled = 1;
        $shippingMethod->zone_name = 'France';
        $shippingMethod->zone_order = 0;
        $shippingMethod->location_id = 2;
        $shippingMethod->location_code = 'FR';
        $shippingMethod->location_type = 'country';

        $shippingMethodInformation = (new ShippingMethodService)->getShippingMethodInformation($shippingMethod);

        $this->assertInstanceOf(ShippingMethod::class, $shippingMethodInformation);
        $this->assertEquals($shippingMethod->instance_id, $shippingMethodInformation->instanceId);
        $this->assertEquals($shippingMethod->zone_id, $shippingMethodInformation->zoneId);
        $this->assertEquals($shippingMethod->is_enabled, $shippingMethodInformation->enabled);
        $this->assertEquals($shippingMethod->zone_name, $shippingMethodInformation->zone['name']);
        $this->assertEquals($shippingMethod->location_id, $shippingMethodInformation->location['id']);
        $this->assertEquals($shippingMethod->location_code, $shippingMethodInformation->location['code']);
    }

    /**
     * Get shipping method information using an incorrect shipping method parameter
     *
     * @return void
     */
    public function testGetShippingMethodInformationUsingIncorrectShippingMethod()
    {
        $this->expectException(TypeError::class);
        (new ShippingMethodService)->getShippingMethodInformation(null);
    }

    /**
     * Get shipping methods information using correct methods
     *
     * @return void
     */
    public function testGetShippingMethodsInformation()
    {
        $shippingMethod1 = new \stdClass;
        $shippingMethod1->zone_id = 1;
        $shippingMethod1->instance_id = 3;
        $shippingMethod1->method_id = 'flat_rate';
        $shippingMethod1->method_order = 2;
        $shippingMethod1->is_enabled = 1;
        $shippingMethod1->zone_name = 'France';
        $shippingMethod1->zone_order = 0;
        $shippingMethod1->location_id = 2;
        $shippingMethod1->location_code = 'FR';
        $shippingMethod1->location_type = 'country';

        $shippingMethod2 = new \stdClass;
        $shippingMethod2->zone_id = 1;
        $shippingMethod2->instance_id = 3;
        $shippingMethod2->method_id = 'flat_rate';
        $shippingMethod2->method_order = 2;
        $shippingMethod2->is_enabled = 1;
        $shippingMethod2->zone_name = 'France';
        $shippingMethod2->zone_order = 0;
        $shippingMethod2->location_id = 2;
        $shippingMethod2->location_code = 'FR';
        $shippingMethod2->location_type = 'country';

        $methods = [$shippingMethod1, $shippingMethod2];

        $shippingMethodsInformation = (new ShippingMethodService)->getShippingMethodsInformation($methods);

        $this->assertIsArray($shippingMethodsInformation);
        $this->assertCount(2, $shippingMethodsInformation);
        $this->assertInstanceOf(ShippingMethod::class, $shippingMethodsInformation[0]);
        $this->assertEquals($shippingMethod1->instance_id, $shippingMethodsInformation[0]->instanceId);
        $this->assertEquals($shippingMethod1->zone_id, $shippingMethodsInformation[0]->zoneId);
        $this->assertEquals($shippingMethod1->is_enabled, $shippingMethodsInformation[0]->enabled);
        $this->assertEquals($shippingMethod1->zone_name, $shippingMethodsInformation[0]->zone['name']);
        $this->assertEquals($shippingMethod1->location_id, $shippingMethodsInformation[0]->location['id']);
        $this->assertEquals($shippingMethod1->location_code, $shippingMethodsInformation[0]->location['code']);
        $this->assertInstanceOf(ShippingMethod::class, $shippingMethodsInformation[0]);
        $this->assertEquals($shippingMethod2->instance_id, $shippingMethodsInformation[1]->instanceId);
        $this->assertEquals($shippingMethod2->zone_id, $shippingMethodsInformation[1]->zoneId);
        $this->assertEquals($shippingMethod2->is_enabled, $shippingMethodsInformation[1]->enabled);
        $this->assertEquals($shippingMethod2->zone_name, $shippingMethodsInformation[1]->zone['name']);
        $this->assertEquals($shippingMethod2->location_id, $shippingMethodsInformation[1]->location['id']);
        $this->assertEquals($shippingMethod2->location_code, $shippingMethodsInformation[1]->location['code']);
    }

    /**
     * Get shipping methods information using incorrect methods
     *
     * @return void
     */
    public function testGetShippingMethodsInformationUsingIncorrectMethods()
    {
        $this->expectException(TypeError::class);

        $shippingMethod = new \stdClass;
        $shippingMethod->zone_id = 1;
        $shippingMethod->instance_id = 3;
        $shippingMethod->method_id = 'flat_rate';
        $shippingMethod->method_order = 2;
        $shippingMethod->is_enabled = 1;
        $shippingMethod->zone_name = 'France';
        $shippingMethod->zone_order = 0;
        $shippingMethod->location_id = 2;
        $shippingMethod->location_code = 'FR';
        $shippingMethod->location_type = 'country';

        (new ShippingMethodService)->getShippingMethodsInformation($shippingMethod);
    }
}
