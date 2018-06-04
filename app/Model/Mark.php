<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    public function theClass()
    {
        return $this->belongsTo(TheClass::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function examTerm()
    {
        return $this->belongsTo(ExamTerm::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

}
