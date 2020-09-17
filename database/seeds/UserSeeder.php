<?php

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
            'name' => 'Sebastianus Sembara',
            'email' => 'sembara9090@gmail.com',
            'email_verified_at' => (new datetime()),
            'password' => Hash::make('mysecret'),
            'avatar' => 'default.jpg'
        ]);
    }
}
