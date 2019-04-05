<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ='categories';

    public function task(){
        return $this->hasMany('App\Task','categories_id');
    }

    public function project(){
        return $this->belongsTo('App\Project','projects_id');
    }
}
