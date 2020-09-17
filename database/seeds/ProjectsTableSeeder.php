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
        Project::truncate();

        $faker = \Faker\Factory::create();

        $teachers = \App\Teacher::all();

//        $image_name = $faker->image('storage/app/public/projects', 400, 300, null);

        foreach ($teachers as $teacher){
            Project::create([
                'title' => $faker->sentence(6),
                'general_objective' => $faker->sentence(6),
                'specifics_objectives'=> $faker->sentence(6),
                'cronogram' =>$faker->imageUrl(400,300, null, false),
                'uploaded_at'=>$faker->dateTime,
                'report_pdf'=>$faker->word,
                'report_uploaded_at'=>$faker->dateTime,
                'report_modified_at'=>$faker->dateTime,
                'teacher_id'=>$teacher->id,

            ]);
        }

    }
}
