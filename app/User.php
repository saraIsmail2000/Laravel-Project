<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $attributes = [
        'role' => 0,
        'approved' => false,
        'workshop_id' => 0,
        'ItoRate' => 0,
        'group_id' => 0,
    ];

    public function workshop() {
        return $this->belongsTo(Workshop::class);
    }

    public function idea() {
        return $this->hasOne(Idea::class);
    }

    //belongs to group
    public function group() {
        return $this->belongsTo(Group::class);
    }

}
