<?php

use App\TeacherPlan;
use Illuminate\Database\Seeder;

class TeachersPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TeachersPlans::truncate();

        $faker = \Faker\Factory::create();

        $teachers = \App\Teacher::all();



        foreach ($teachers as $teacher){
            TeacherPlan::create([
                'title' => $faker->sentence,
                'problem' => $faker->paragraph,
                'solution'=> $faker->paragraph,
                'teachers_id'=>$teacher->id,
            ]);
        }
    }
}
