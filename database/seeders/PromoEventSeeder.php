<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PromoEventSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('promo_events')->insert([
      'promo_code' => 'BLCKFRI_15',
      'discount' => 300,
      'min_spend' => 700,
      'voucher_limit' => 50,
      'expiry_date' => now(),
    ]);
  }
}
