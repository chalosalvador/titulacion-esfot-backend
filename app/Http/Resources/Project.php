<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;

class Project extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $teacher = $this->teacher->user;
        return [
            'id' => $this->id,
            'title' => $this->title,
            'title_comment' => $this->title_comment,
            'general_objective' => $this->general_objective,
            'general_objective_comment' => $this->general_objective_comment,
            'specifics_objectives' => $this->specifics_objectives,
            'specifics_objectives_comment' => $this->specifics_objectives_comment,
            'status' => $this->status,
            'problem' => $this->problem,
            'problem_comment' => $this->problem_comment,
            'justification' => $this->justification,
            'justification_comment' => $this->justification_comment,
            'hypothesis' => $this->hypothesis,
            'hypothesis_comment' => $this->hypothesis_comment,
            'methodology' => $this->methodology,
            'methodology_comment' => $this->methodology_comment,
            'research_line' => $this->research_line,
            'knowledge_area' => $this->knowledge_area,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'uploaded_at' => $this->uploaded_at,
            'work_plan' => $this->work_plan,
            'work_plan_comment' => $this->work_plan_comment,
            'bibliography' => $this->bibliography,
            'bibliography_comment' => $this->bibliography_comment,
            'project_type' => $this->project_type,
            'report_pdf' => $this->report_pdf,
            'report_uploaded_at' => $this->report_uploaded_at,
            'report_modified_at' => $this->report_modified_at,
            'teacher' => '/api/teachers/' . $this->teacher_id,
            'teacher_name' => $teacher->name,
            'teacher_id' => $this->teacher_id,
            'schedule'=>$this->schedule,
            'schedule_comment'=>$this->schedule_comment,
            'students' => $this->getStudents(),
        ];
    }

    private function getStudents() {
        $students = [];

        foreach($this->students as $student) {
            $students[] = [
                'id' => $student->id,
                'name' => $student->user->name,
                'lastname' => $student->user->lastname,
            ];
        }

        return $students;
    }
}
