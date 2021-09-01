<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['active_mission_count'];

    public function characters()
    {
        return $this->hasMany(Character::class, 'accid', 'game_account_id');
    }

    public function activeCharacter()
    {
        return $this->hasOne(Character::class, 'charid', 'active_char_id')->with('zone');
    }

    public function missions()
    {
        return $this->hasMany(MissionUndertaken::class);
    }

    public function activeMissions()
    {
        return$this->hasMany(MissionUndertaken::class)->where('end_time', '>', now());
    }

    public function getActiveMissionCountAttribute() 
    {
        return $this->activeMissions()->count();
    }

    
}
