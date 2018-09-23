<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Illuminate\Database\Seeder;
use espacios\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('users')->delete();

        User::create([
            'email' => "demo@demo.com",
            'name'=> "Luis E.",
            'password'=> bcrypt('demo'),
            'job_title'=> "Developer",
            'location'=> "Monterrey NL."
        ]);

        for ($i=1; $i<=100;$i++){
            User::create([
                'email' => $faker->unique()->email,
                'name'=> $faker->name,
                'password'=> bcrypt('demo'),
                'job_title'=> $faker->jobTitle,
                'location'=> $faker->cityPrefix
            ]);
        }

    }

}