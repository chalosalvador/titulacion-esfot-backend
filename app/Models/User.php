<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    const ROLE_SUPERADMIN = 'ROLE_SUPERADMIN';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_STUDENT = 'ROLE_STUDENT';
    const ROLE_TEACHER = 'ROLE_TEACHER';
    const ROLE_SECRETARY = 'ROLE_SECRETARY';
//    const ROLE_USER = 'ROLE_USER';

    private const ROLE_HIERARCHY = [
        self::ROLE_SUPERADMIN => [self::ROLE_ADMIN],
        self::ROLE_ADMIN => [self::ROLE_STUDENT, self::ROLE_TEACHER],
        self::ROLE_TEACHER => [],
        self::ROLE_STUDENT => [],
        self::ROLE_SECRETARY => []
//        self::ROLE_USER=>[]
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function userable()
    {
        return $this->morphTo();
    }

    public function isGranted($role)
    {
        if ($role === $this->role) {
            return true;
        }
        return self::isRoleInHierarchy($role, self::ROLE_HIERARCHY[$this->role]);
    }

    public static function isRoleInHierarchy($role, $role_hierarchy)
    {
        if (in_array($role, $role_hierarchy)) {
            return true;
        }

        foreach ($role_hierarchy as $role_included) {
            if (self::isRoleInHierarchy($role, self::ROLE_HIERARCHY[$role_included])) {
                return true;
            }
        }
        return false;
    }
}
