<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Secretary;
use App\Models\Administrative;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        Administrative::truncate();

        $faker = \Faker\Factory::create();

        $password = Hash::make('123456');


        User::create([
            'name' => 'Administrador',
            'last_name' => 'Principal',
            'email' => 'admin@prueba.com',
            'password' => $password,
            'userable_id' => 0,
            'userable_type' => 'App\Admin',
            'role' => User::ROLE_SUPERADMIN]);
        $secretary = Secretary::create(['office' => $faker->randomDigit]);
        $administrative = Administrative::create(['office' => $faker->randomDigit]);
        $administrative->user()->create([
            'name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => 'admin@epn.edu.ec',
            'password' => $password,
            'role' => User::ROLE_ADMIN
        ]);
        $secretary->user()->create([
            'name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => 'secretaria@epn.edu.ec',
            'password' => $password,
            'role' => User::ROLE_SECRETARY
        ]);

        for ($i = 0; $i < 10; $i++) {
            $student = Student::create(['apto' => $faker->boolean, 'unique_number' => $faker->word, 'career_id' => $faker->numberBetween(1, 8)]);
            $teacher = Teacher::create(['titular' => $faker->boolean,'schedule' => $faker->word, 'career_id' => $faker->numberBetween(1, 8)]);
            $student->user()->create([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => "estudiante$i@epn.edu.ec",
                'password' => $password,
                'role' => User::ROLE_STUDENT
            ]);
            $teacher->user()->create([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => "profesor$i@epn.edu.ec",
                'password' => $password,
                'role' => User::ROLE_TEACHER
            ]);
        }

    }
}
