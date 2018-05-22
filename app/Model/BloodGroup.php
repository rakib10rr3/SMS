<?php

namespace App\Model;

use App\Stuff;
use App\Teacher;
use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    public function teachers(){
        return $this->hasMany(Teacher::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function staffs(){
        return $this->hasMany(Staff::class);
    }
}
