<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use espacios\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('users')->delete();

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
