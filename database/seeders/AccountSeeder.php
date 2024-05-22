<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accounts')->insert([
            'id' => 1,
            'school' => 'Benue State Poly',
            'motto' => 'Knowledge and Hardwork',
            'logo' => 'images/benpoly-logo.png',
            'state' => 'Benue',
            'pob' => '10023',
            'created_at' => now(),
            'updated_at' => now(),
            'email' => 'benpoly@poly.edu.ng',
            'phone' => '07036996299',
            'address' => 'Benue State',
        ]);
    }
}
