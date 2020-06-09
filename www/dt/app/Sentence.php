<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    protected $fillable = ['en', 'ru', 'file_id', 'count_words', 'count_symbols'];

    public function words()
    {
        return $this->belongsToMany('App\Word');
    }

    public function file()
    {
        return $this->belongsTo('App\File');
    }
}
