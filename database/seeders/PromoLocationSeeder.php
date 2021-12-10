<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PromoLocationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('promo_locations')->insert([
      [
        'promo_event_id' => 1,
        'lat' => '-1.297743',
        'lng' => '36.763525',
      ], [
        'promo_event_id' => 1,
        'lat' => '-1.297325',
        'lng' => '36.761647',
      ], [
        'promo_event_id' => 1,
        'lat' => '-1.297432',
        'lng' => '36.761443',
      ], [
        'promo_event_id' => 1,
        'lat' => '-1.298590',
        'lng' => '36.761443',
      ], [
        'promo_event_id' => 1,
        'lat' => '-1.298901',
        'lng' => '36.762548',
      ], [
        'promo_event_id' => 1,
        'lat' => '-1.298536',
        'lng' => '36.762709',
      ], [
        'promo_event_id' => 1,
        'lat' => '-1.298557',
        'lng' => '36.763310',
      ], [
        'promo_event_id' => 1,
        'lat' => '-1.297743',
        'lng' => '36.763525',
      ]
    ]);
  }
}
