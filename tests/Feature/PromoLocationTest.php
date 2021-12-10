<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class PromoLocationTest extends TestCase
{

    public function testCreatePromoLocation()
    {
        $data = [
            'promo_event_id' => 1,
            'lat' => -1.2980113362523562,
            'lng' => 36.762505683390444,
        ];

        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->json('POST', '/api/promolocation/add', $data);
        $response->assertStatus(200);
        $response->assertJson(['status' => 'success']);
        $response->assertJson(['message' => "Location has been successfully added."]);
    }
}
