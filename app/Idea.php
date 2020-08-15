<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model {
    
    protected $fillable = [
        'solution',
    ];
    
    protected $attributes = [
        'rating' => 0,
        'taken' => 0,
    ];

    public function workshop() {
        return $this->belongsTo(Workshop::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }


}
