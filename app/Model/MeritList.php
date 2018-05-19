<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class MeritList extends Model
{
    public function theClass()
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

    public function examTerms()
    {
        return $this->belongsTo(ExamTerm::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

}
