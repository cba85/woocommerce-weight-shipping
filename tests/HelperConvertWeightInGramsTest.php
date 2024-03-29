<?php

class HelperConvertWeightInGramsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Convert a weight in g unit to g
     *
     * @return void
     */
    public function testConvertWeightInGramsUnitToGrams()
    {
        $weight = 1;
        $woocommerceWeightUnit = 'g';
        $convertedWeight = convertWeightUnitToGrams($weight, $woocommerceWeightUnit);
        $this->assertEquals(1, $convertedWeight);
    }

    /**
     * Convert a weight in kg unit to g
     *
     * @return void
     */
    public function testConvertWeightInKilogramsUnitToGrams()
    {
        $weight = 1;
        $woocommerceWeightUnit = 'kg';
        $convertedWeight = convertWeightUnitToGrams($weight, $woocommerceWeightUnit);
        $this->assertEquals(1000, $convertedWeight);
    }

    /**
     * Convert a weight in lbs unit to g
     *
     * @return void
     */
    public function testConvertWeightInLbsUnitToGrams()
    {
        $weight = 1;
        $woocommerceWeightUnit = 'lbs';
        $convertedWeight = convertWeightUnitToGrams($weight, $woocommerceWeightUnit);
        $this->assertEquals(453.59237, $convertedWeight);
    }

    /**
     * Convert a weight in oz unit to g
     *
     * @return void
     */
    public function testConvertWeightInOzUnitToGrams()
    {
        $weight = 1;
        $woocommerceWeightUnit = 'oz';
        $convertedWeight = convertWeightUnitToGrams($weight, $woocommerceWeightUnit);
        $this->assertEquals(28.3495, $convertedWeight);
    }
}
