<?php

class HelperGetClosestWeightVariationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Get closest weight variation when a shipping method doesn't have any
     *
     * @return void
     */
    public function testGetClosestWeightVariationWithoutWeightVariation()
    {
        $closestWeightVariation = getClosestWeightVariation([], 1000);
        $this->assertNull($closestWeightVariation);
    }

    /**
     * Get closest weight variation when a shipping method has any
     *
     * @return void
     */
    public function testGetClosestWeightVariationWithWeightVariation()
    {
        $weightVariations = [
            [
                'weight' => 1000,
                'cost' => 10,
            ],
            [
                'weight' => 1500,
                'cost' => 15,
            ],
            [
                'weight' => 500,
                'cost' => 5,
            ],
        ];

        $closestWeightVariation = getClosestWeightVariation($weightVariations, 200);
        $this->assertNull($closestWeightVariation);

        $closestWeightVariation = getClosestWeightVariation($weightVariations, 700);
        $this->assertEquals(5, $closestWeightVariation['cost']);

        $closestWeightVariation = getClosestWeightVariation($weightVariations, 1000);
        $this->assertEquals(10, $closestWeightVariation['cost']);

        $closestWeightVariation = getClosestWeightVariation($weightVariations, 2000);
        $this->assertEquals(15, $closestWeightVariation['cost']);
    }
}
