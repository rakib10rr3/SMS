<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    public function theClasses()
    {
        return $this->belongsTo(TheClass::class);
    }

    public function sections()
    {
        return $this->belongsTo(Section::class);
    }

    public function shifts()
    {
        return $this->belongsTo(Shift::class);
    }

    public function students()
    {
        return $this->belongsTo(Student::class);
    }

    public function examTerms()
    {
        return $this->belongsTo(ExamTerm::class);
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

}
