<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // Create just one user
        DB::table('users')->insert([
            'email' => 'pierre-yves@zenaton.com',
            'name' => 'Pierre-Yves',
            'password' => Hash::make('secret'),
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        // Create just one product
        DB::table('products')->insert([
            'name' => 'Beer x24',
            'price' => 1999,
            'currency' => 'EUR',
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
