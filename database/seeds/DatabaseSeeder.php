<?php

use App\User;
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
        // $this->call(UsersTableSeeder::class);
        User::create(['first_name' => 'admin', 'last_name' => 'site', 'mobile' => '09371234567', 'email' => 'test@test.com', 'password' => bcrypt('secret')]);
    }
}
