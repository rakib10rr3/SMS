<?php

namespace App\Model;

use App\Teacher;
use Illuminate\Database\Eloquent\Model;

class TheClass extends Model
{

    protected $guarded = [];


    public function students(){
        return $this->hasMany(Student::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }


    public function sections(){
        return $this->belongsToMany('App\Model\Subject', 'subject_assigns', 'teacher_id', 'subject_id');
    }

    public function classAssigns(){
        return$this->hasMany(ClassAssign::class);
    }

    public function marks(){
        return$this->hasMany(Mark::class);
    }

    public function meritLists(){
        return$this->hasMany(MeritList::class);
    }

    public function attendances(){
        return$this->hasMany(Attendance::class);
    }

    //todo 4: class  belongs to many teacher
    public function teachers()
    {
        return $this->belongsToMany('App\Model\Subject', 'subject_assigns', 'teacher_id', 'subject_id');

    }
}
