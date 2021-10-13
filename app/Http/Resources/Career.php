<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Commission as CommissionResource;
use App\Http\Resources\TeacherCollection;

class Career extends JsonResource
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
            'name'=>$this->name,
            'commission'=>new CommissionResource($this->commission),
            'teachers'=>new TeacherCollection($this->teachers),
        ];
    }
}
