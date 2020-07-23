<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\TeacherCollection as TeacherResource;

class TeacherPlanCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id'=>$this->id,
          'title'=>$this->title,
          'problem'=>$this->problem,
          'solution'=>$this->solution,
          'created_at'=>$this->created_at,
          'updated_at'=>$this->updated_at,
          'teachers_id'=>TeacherResource::collection($this->teachers_id)
        ];
    }
}
