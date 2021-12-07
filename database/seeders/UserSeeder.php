<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'first_name' => 'Admin',
          'last_name' => 'Safeboda',
          'email' => 'admin@safeboda.com',
          'phone_number' => '+254724000000',
          'email_verified_at' => now(),
          'password' => Hash::make('fixthecar'),
          'rights_group' => 1
      ]);
    }
}
