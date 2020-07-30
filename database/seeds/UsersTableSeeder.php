<?php

use App\Students;
use App\Teachers;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $faker = \Faker\Factory::create();

        $password = Hash::make('123456');


        User::create(['name' => 'Administrador', 'email' => 'admin@prueba.com', 'password' => $password,'userable_id'=>0,'userable_type'=>'App\Admin']);

        for ($i = 0; $i < 10; $i++) {
            $student = Students::create(['apto'=>$faker->boolean,'unique_number'=>$faker->word]);
            $teacher = Teachers::create(['titular'=>$faker->boolean]);
            $student->user() -> create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
                ]);
            $teacher->user() -> create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
            ]);

        }


    }
}
