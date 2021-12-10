<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

use App\Models\User;
use App\Models\PromoCode;

class PromoCodeTest extends TestCase
{

    public function testGettingAllPromoCodes()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/promocode/all');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'current_page',
                'data',
                'first_page_url',
                'from',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to'
            ]
        );
    }

    public function testGettingActivePromoCodes()
    {
        $user = $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('GET', '/api/promocode/active');
        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'current_page',
                'data',
                'first_page_url',
                'from',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to'
            ]
        );
    }

    public function testPromoWithMiddleware()
    {
        $data = [
            'promo_code' => "BLCKFRI_15bv0ln",
            'lat_origin' => -1.2980113362523562,
            'lng_origin' => 36.762505683390444,
            'lat_dest' => -1.2909627,
            'lng_dest' => 36.7982006,
        ];

        $response = $this->json('POST', '/api/promo', $data);
        $response->assertStatus(401);
        $response->assertJson(['message' => "Unauthenticated."]);
    }

    public function testCheckMissingPromo()
    {
        $data = [
            'promo_code' => "BLCKFRI_15bv0ln",
            'lat_origin' => -1.2980113362523562,
            'lng_origin' => 36.762505683390444,
            'lat_dest' => -1.2909627,
            'lng_dest' => 36.7982006,
        ];
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->json('POST', '/api/promo', $data);
        $response->assertStatus(500);
        $response->assertJson(['status' => 'error']);
        $response->assertJson(['message' => "Your promotion code is not valid or has expired"]);
    }

    public function testCheckValidPromo()
    {

        $this->artisan('db:seed');

        $promo = [
            'promo_event_id' => 1,
            'name' => 'BLCKFRI_15bv0ln',
        ];

        (new PromoCode)->add($promo);

        $data = [
            'promo_code' => $promo['name'],
            'lat_origin' => -1.2980113362523562,
            'lng_origin' => 36.762505683390444,
            'lat_dest' => -1.2909627,
            'lng_dest' => 36.7982006,
        ];

        $user = User::factory()->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/promo', $data);
        $response->assertStatus(200);
        $response->assertJson(['status' => 'success']);
        $response->assertJson(['message' => "Your promotion code is valid for 15%"]);
        $response->assertJsonFragment(['discount_percentage' => 15]);
    }

}
