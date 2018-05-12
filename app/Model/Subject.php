<?php

namespace App\Model;

use App\Model\OptionalAssign;
use App\Teacher;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded=[];


    public function theClass(){
        return $this->belongsTo(TheClass::class);
    }


    public function classAssigns(){
        return$this->hasMany(ClassAssign::class);
    }

    public function marks(){
        return$this->hasMany(Mark::class);
    }

    public function attendances(){
        return$this->hasMany(Attendance::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function teachers() {

        return $this->belongsToMany('App\Teacher', 'subject_assigns','subject_id','teacher_id');

    }

    //todo : 1 fix this - (subject to section)
    public function sections() {

        return $this->belongsToMany('App\Teacher', 'subject_assigns','subject_id','teacher_id');
    }


    public function optionalAssigns(){
        return $this->hasMany(OptionalAssign::class);
    }
}
