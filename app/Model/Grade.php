<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $guarded=[];
    public function marks(){
        return $this->hasMany(Mark::class);
    }

    public function meritLists(){
        return $this->hasMany(MeritList::class);

    }
   
    function ts_get_grade($value)
    {
       //static $grades = grade::get();
        
    }
}
