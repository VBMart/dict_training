<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['word'];

    public function sentences()
    {
        return $this->belongsToMany('App\Sentence');
    }
}
