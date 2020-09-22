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
            'general_objective' => $this->general_objective,
            'specifics_objectives' => $this->specifics_objectives,
            'status' => $this->status,
            'problem' => $this->problem,
            'justification' => $this->justification,
            'hypothesis' => $this->hypothesis,
            'methodology' => $this->methodology,
            'research_line' => $this->research_line,
            'knowledge_area' => $this->knowledge_area,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'uploaded_at' => $this->uploaded_at,
            'report_pdf' => $this->reprt_pdf,
            'report_uploaded_at' => $this->report_uploaded_at,
            'report_modified_at' => $this->report_modified_at,
            'teacher' => '/api/teachers/' . $this->teacher_id,
            'teacher_name' => $teacher->name,
            'teacher_id' => $this->teacher_id,
            'schedule'=>$this->schedule,
        ];
    }
}
