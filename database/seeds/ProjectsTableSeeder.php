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

        $students = \App\Student::all();

//        $image_name = $faker->image('storage/app/public/projects', 400, 300, null);

        foreach ($students as $student) {
            Project::create([
                'title' => $faker->sentence(15),
                'hypothesis' => $faker->paragraph,
                'justification' => $faker->paragraph,
                'methodology' => $faker->paragraph,
                'work_plan' => $faker->paragraph,
                'research_line' => $faker->sentence('5'),
                'knowledge_area' => $faker->sentence('5'),
                'general_objective' => $faker->sentence(15),
                'specifics_objectives' => $faker->sentence(25),
                'schedule' => $faker->imageUrl(400, 300, null, false),
                'uploaded_at' => $faker->dateTime,
                'report_pdf' => $faker->sentence('15'),
                'report_uploaded_at' => $faker->dateTime,
                'report_modified_at' => $faker->dateTime,
                'teacher_id'=>$faker->numberBetween(1,10)
            ]);
//            $student->projects()->sync([$student->id, $faker->numberBetween(1, 10)]);
        }

    }
}
