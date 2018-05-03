<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function marks(){
        return $this->hasMany(Mark::class);
    }

    public function meritLists(){
        return $this->hasMany(MeritList::class);

    }
}
