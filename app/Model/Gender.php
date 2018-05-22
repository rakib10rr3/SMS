<?php

namespace App\Model;

use App\Teacher;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{

    protected $fillable = ['name'];

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function staffs(){
        return $this->hasMany(Staff::class);
    }
}
