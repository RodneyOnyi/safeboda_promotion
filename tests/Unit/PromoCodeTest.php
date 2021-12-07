<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Models\PromoCode;

class PromoCodeTest extends TestCase
{

    public function testValidLocationRadius()
    {
        $point = ["lat" => -1.2983417, "lng" => 36.7625266];
        $fenceArea = [
            ["lat" => -1.297743, "lng" => 36.763525],
            ["lat" => -1.297325, "lng" => 36.761647],
            ["lat" => -1.297432, "lng" => 36.761443],
            ["lat" => -1.298590, "lng" => 36.761443],
            ["lat" => -1.298901, "lng" => 36.762548],
            ["lat" => -1.298536, "lng" => 36.762709],
            ["lat" => -1.298557, "lng" => 36.763310],
            ["lat" => -1.297743, "lng" => 36.763525]
        ];

        $location = (new PromoCode)->locationWithinRadius($point, $fenceArea);
        $this->assertTrue($location);
    }

    public function testInValidLocationRadius()
    {
        $point = ["lat" => -1.3983417, "lng" => 36.7625266];
        $fenceArea = [
            ["lat" => -1.297743, "lng" => 36.763525],
            ["lat" => -1.297325, "lng" => 36.761647],
            ["lat" => -1.297432, "lng" => 36.761443],
            ["lat" => -1.298590, "lng" => 36.761443],
            ["lat" => -1.298901, "lng" => 36.762548],
            ["lat" => -1.298536, "lng" => 36.762709],
            ["lat" => -1.298557, "lng" => 36.763310],
            ["lat" => -1.297743, "lng" => 36.763525]
        ];

        $location = (new PromoCode)->locationWithinRadius($point, $fenceArea);
        $this->assertFalse($location);
    }
}
