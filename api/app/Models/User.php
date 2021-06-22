<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * Fetch User Skill
     *
     * @return void
     */
    public function skill()
    {
        return $this->hasOne('App\Models\Skill', 'user_id');
    }

    /**
     * Fetch User Access
     *
     * @return void
     */
    public function access()
    {
        return $this->hasOne('App\Models\Access', 'user_id');
    }
}
