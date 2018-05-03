<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function theClass(){
        return $this->belongsTo(TheClass::class);
    }

    public function shift(){
        return $this->belongsTo(Shift::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function religion(){
        return $this->hasOne(Religion::class);
    }

    public function bloodGroup(){
        return $this->belongsTo(BloodGroup::class);
    }

    public function gender(){
        return $this->belongsTo(Gender::class);
    }


    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function marks(){
        return$this->hasMany(Mark::class);
    }

    public function meritLists(){
        return$this->hasMany(MeritList::class);
    }

    public function attendances(){
        return$this->hasMany(Attendance::class);
    }

}
