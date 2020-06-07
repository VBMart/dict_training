<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OxfordWord extends Model
{
    protected $fillable = ['en', 'ru1', 'ru2', 'level_id'];

    public function level()
    {
        return $this->hasOne('App\Level');
    }
}
