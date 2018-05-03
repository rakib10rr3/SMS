<?php

namespace App;

use App\Model\BloodGroup;
use App\Model\ClassAssign;
use App\Model\Gender;
use App\Model\Religion;
use App\Model\Subject;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function religion(){
        return $this->belongsTo(Religion::class);
    }

    public function bloodGroup(){
        return $this->belongsTo(BloodGroup::class);
    }

    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return$this->hasMany(Subject::class);
    }

    public function classAssigns(){
        return$this->hasMany(ClassAssign::class);
    }

}
