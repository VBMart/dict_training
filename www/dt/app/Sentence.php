<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    protected $fillable = ['en', 'ru', 'file_id', 'count_words', 'count_symbols'];
}
