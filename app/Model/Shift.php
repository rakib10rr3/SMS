<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $guarded=[];
    public function Attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }

    public function marks(){
        return$this->hasMany(Mark::class);
    }

    public function meritLists(){
        return$this->hasMany(MeritList::class);
    }
}
