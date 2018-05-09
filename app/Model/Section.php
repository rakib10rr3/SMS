<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function meritLists()
    {
        return $this->hasMany(MeritList::class);
    }

    public function class_assigns()
    {
        return $this->hasMany(ClassAssign::class);
    }

    //todo :   fix this - (section belongs to many class)
    public function classes()
    {
        return $this->belongsToMany('App\Teacher', 'subject_assigns', 'subject_id', 'teacher_id');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Teacher', 'subject_assigns', 'subject_id', 'teacher_id');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Teacher', 'subject_assigns', 'subject_id', 'teacher_id');
    }
}
