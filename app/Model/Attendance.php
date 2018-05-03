<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function theClasses()
    {
        return $this->belongsTo(TheClass::class);
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }

    public function students()
    {
        return $this->belongsTo(Student::class);
    }
}
