<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $guarded=[];
    public function students(){
        return $this->hasMany(Student::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }
}
