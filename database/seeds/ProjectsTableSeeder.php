<?php

use App\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Project::truncate();

        $faker = \Faker\Factory::create();

        $teachers = \App\Teachers::all();

        foreach ($teachers as $teacher){
            Project::create([
                'title' => $faker->word,
                'general_objective' => $faker->word,
                'specifics_objectives'=> $faker->word,
                'uploaded_at'=>$faker->dateTime,
                'report_pdf'=>$faker->word,
                'report_uploaded_at'=>$faker->dateTime,
                'report_modified_at'=>$faker->dateTime,
                'teachers_id'=>$teacher->id,
            ]);
        }

    }
}
