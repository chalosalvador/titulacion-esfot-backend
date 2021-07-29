<?php

namespace Database\Seeders;

use App\Models\Project;
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

        $students = \App\Models\Student::all();

//        $image_name = $faker->image('storage/app/public/projects', 400, 300, null);

        foreach ($students as $student) {
            $project = Project::create([
                'title' => $faker->sentence(15),
                'hypothesis' => $faker->paragraph,
                'justification' => $faker->paragraph,
                'methodology' => $faker->paragraph,
                'work_plan' => $faker->paragraph,
                'research_line' => $faker->sentence('5'),
                'knowledge_area' => $faker->sentence('5'),
                'general_objective' => $faker->sentence(15),
                'specifics_objectives' => $faker->sentence(15),
                'schedule' => $faker->imageUrl(400, 300, null, false),
                'problem'=>$faker->paragraph,
                'project_type' => $faker->sentence(15),
                'bibliography' => $faker->sentence(30),
                'uploaded_at' => $faker->dateTime,
                'report_pdf' => $faker->sentence('15'),
                'report_uploaded_at' => $faker->dateTime,
                'report_modified_at' => $faker->dateTime,
                'teacher_id'=>$faker->numberBetween(1,10)
            ]);
            $hasTwoStudents = $faker->boolean();
            $studentIds = [$student->id];
            if($hasTwoStudents) {
                $studentIds[] = $faker->numberBetween(1, 10);
            }
            $project->students()->sync($studentIds);
        }

    }
}
