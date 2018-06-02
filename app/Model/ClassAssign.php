<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClassAssign extends Model
{

    protected $guarded=[];

    public function theClass()
    {
        return $this->belongsTo(TheClass::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
