<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class TeacherPlan extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $teacher = $this->teacher->user;
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'problem'=>$this->problem,
            'solution'=>$this->solution,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'teacher'=>'/api/teachers/'.$this->teachers_id,
            'teacher_name'=>$teacher->name
        ];
    }
}
