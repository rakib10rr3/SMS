<?php

namespace App\Model;

use App\Teacher;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function teachers(){
        return $this->belongsToMany(Teacher::class);
    }

    public function class(){
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
}
