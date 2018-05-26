<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded = [];


    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function classAssigns()
    {
        return $this->hasMany(ClassAssign::class);
    }


}
