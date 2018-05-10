<?php

namespace App\Model;

use App\Model\Student;
use App\Model\Subject;
use Illuminate\Database\Eloquent\Model;

class OptionalAssign extends Model
{

    protected $guarded=[];

    public function students(){
        return $this->belongsTo(Student::class);
    }

    public function subjects(){
        return $this->belongsTo(Subject::class);
    }
}
