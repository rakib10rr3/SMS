<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded=[];
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function theClass()
    {
        return $this->belongsTo(TheClass::class);
    }


    public function students()
    {
        return $this->belongsTo(Student::class);
    }
}
