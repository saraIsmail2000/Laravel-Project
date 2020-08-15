<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    //has many users
    
    protected $attributes = [
        'idea_id' => 0,
        'workshop_id' => 0,
    ];

    public function workshop() {
        return $this->belongsTo(Workshop::class);
    }
    
    public function idea(){
        return $this->belongsTo(Idea::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }

}
