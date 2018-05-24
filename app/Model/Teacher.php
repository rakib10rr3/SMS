<?php

namespace App\Model;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = [];


    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function classAssigns()
    {
        return $this->hasMany(ClassAssign::class);
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Model\Subject', 'subject_assigns', 'teacher_id', 'subject_id');
    }

    //todo : teacher belongs to many class
    public function classes()
    {
        return $this->belongsToMany('App\Model\Subject', 'subject_assigns', 'teacher_id', 'subject_id');
    }
    //todo : teacher belongs to many sections
    public function sections()
    {
        return $this->belongsToMany('App\Model\Subject', 'subject_assigns', 'teacher_id', 'subject_id');
    }


}
