<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Teacher extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $career = $this->career;

        return [
            'id'=>$this->id,
            'titular'=>$this->titular,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'career' => $career->name,
            'committee'=>$this->committee,
            'career_id'=>$this->career_id,
            'schedule'=>$this->schedule
        ];
    }
}
