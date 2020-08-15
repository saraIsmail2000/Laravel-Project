<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    //
    protected $fillable = [
        'Title', 'Problem', 'Link' , 'nb_users' , 'user_id' ,
    ];

    protected $attributes = [
        'stage' => 0,
        'round' => 0,
        'nbRates' => 0,
    ];

    public function facilitator() {
        return $this->belongsTo(User::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }

    public function ideas() {
        return $this->hasMany(Idea::class);
    }

    public function groups() {
        return $this->hasMany(Group::class);
    }
}
