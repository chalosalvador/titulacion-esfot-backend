<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class User extends JsonResource implements CanResetPasswordInterface
{
    use Notifiable;
    use CanResetPassword;
    protected $token;


    public function __construct($resource, $token = null)
    {
        parent::__construct($resource);
        $this->token = $token;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'userable'=>$this->userable,
//            'unique_number'=>$this->when(Auth::user()->userable_type=='App\Student',$this->userable->unique_number),
            $this->merge($this->userable),
            'role'=>$this->role,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'token' => $this->when($this->token, $this->token),
        ];
    }
}
