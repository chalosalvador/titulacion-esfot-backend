<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Jury extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'tribunalSchedule'=>$this->tribunalSchedule,
            'teachers'=>new TeacherCollection($this->teachers),
            'project'=> new Project($this->project),
            'project_id' => $this->project_id
        ];
    }
}
