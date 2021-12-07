<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RightsGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rights_group')->insert([
            [
                'name' => 'Super Admin',
                'role' => 'admin',
                'description' => 'Full access to the system.',
                'created_by' => 1
            ], [
                'name' => 'Client',
                'role' => 'client',
                'description' => 'Client access.',
                'created_by' => 1
            ]
        ]);
    }
}
