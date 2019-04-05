<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table ='tasks';

    public function user(){
        return $this->belongsTo('App\User','users_id');
    }

    public function category(){
        return $this->belongsTo('App\Category','categories_id');
    }
}
