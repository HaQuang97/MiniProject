<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Project extends Model
{
    protected $table ='users_projects';

    public function project(){
        return $this->belongsTo('App\Project','projects_id');
    }

    public function user(){
        return $this->belongsTo('App\User','users_id');
    }
}
