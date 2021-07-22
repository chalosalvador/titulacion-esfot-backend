<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Commission extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $teachers = $this->teachers($this->teachers);
        $career = $this->career;
        return [
            'id'=>$this->id,
            'commission_schedule'=>$this->commission_schedule,
            'career_id'=>$this->career_id,
            'career_name'=>$career->name,
            'members'=>$teachers
        ];
    }
    private function teachers($teachers){
        $teachersUsers=[];
        foreach ($teachers as $teacher){
            $teachersUsers[] = [
                'name'=>$teacher->user->name,
                'email'=>$teacher->user->email
            ];
        }
        return $teachersUsers;
    }
}
