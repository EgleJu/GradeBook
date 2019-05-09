<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //teacher user

        DB::table('users')->insert([
            'name' =>$faker->name,
            'email' =>'teacher1@example.com',
            'password' => Hash::make('mokytojas1'),//mokytojas1
            'remember_token' => str_random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'email_verified_at' => now(),
        ]);
    }
}
