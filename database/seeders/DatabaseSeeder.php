<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->addCart()->create(["email" => "a@hot.com"]);
        // $this->call([
        //     ProductSeeder::class
        // ]);
    }
}
