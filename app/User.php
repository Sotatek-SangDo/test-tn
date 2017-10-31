<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Log;

class User extends Authenticatable
{
    use Notifiable;

    const TYPE_ADMIN = 1;
    const IS_ACTIVE = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'phone', 'password', 'class', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function isAdmin()
    {
        return $this->is_admin == User::TYPE_ADMIN;
    }

    public function isActive()
    {
        Log::info(1);
        Log::info($this->is_active);
        return;
        return $this->is_active == User::IS_ACTIVE;
    }
}
