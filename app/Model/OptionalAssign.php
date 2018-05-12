<?php

namespace App\Model;

use App\Model\Student;
use App\Model\Subject;
use Illuminate\Database\Eloquent\Model;

class OptionalAssign extends Model
{

    protected $guarded=[];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
