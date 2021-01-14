<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
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
            'apto'=>$this->apto,
            //'name'=>$this->user->name,
            'unique_number'=>$this->unique_number,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'project'=>$this->projects,
            'user'=>$this->user
        ];
    }
}
