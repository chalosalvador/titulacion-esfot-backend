<?php

use App\Student;
use App\Teacher;
use App\User;
use App\Secretary;
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
        Teacher::truncate();
        Student::truncate();

        $faker = \Faker\Factory::create();

        $password = Hash::make('123456');


        User::create([
            'name' => 'Administrador',
            'email' => 'admin@prueba.com',
            'password' => $password,
            'userable_id' => 0,
            'userable_type' => 'App\Admin',
            'role'=>User::ROLE_SUPERADMIN]);

        for ($i = 0; $i < 10; $i++) {
            $student = Student::create(['apto' => $faker->boolean, 'unique_number' => $faker->word]);
            $teacher = Teacher::create(['titular' => $faker->boolean]);
            $secretary = Secretary::create(['titular'=>$faker->boolean]);
            $student->user()->create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
                'role'=>User::ROLE_STUDENT
            ]);
            $teacher->user()->create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
                'role'=>User::ROLE_TEACHER
            ]);
            $secretary->user()->create([
               'name'=>$faker->name,
               'email'=>$faker->email,
               'password'=>$password,
               'role'=>User::ROLE_SECRETARY
            ]);

        }


    }
}
