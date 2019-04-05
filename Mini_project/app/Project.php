<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $guarded = [];

    public function category(){
        return $this->hasMany('App\Category','projects_id');
    }

    public function user_project(){
        return $this->hasMany('App\User_Project','projects_id');
    }

}
