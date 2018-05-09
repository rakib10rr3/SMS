<?php

namespace App\Model;

use App\Teacher;
use Illuminate\Database\Eloquent\Model;

class ClassAssign extends Model
{
    public function theClasses(){
        return $this->belongsTo(TheClass::class);
    }

    public function subjects(){
        return $this->belongsTo(Subject::class);
    }

    public function teachers(){
        return $this->belongsTo(Teacher::class);
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
