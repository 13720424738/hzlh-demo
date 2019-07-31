<?php

namespace Modules\Crew\Entities\Crew;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Crew extends Authenticatable implements JWTSubject
{
    //
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['username', 'password', 'avatar',];
    use Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }
}
