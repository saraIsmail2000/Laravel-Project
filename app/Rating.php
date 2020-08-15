<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Rating extends Model
{
    //

    protected $attributes = [
        'workshop_id' => 0,
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function idea(){
        return $this->belongsTo(Idea::class);
    }    
}
