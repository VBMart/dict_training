<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['file_name', 'using'];

    public function sentences()
    {
        return $this->hasMany('App\Sentence');
    }
}
