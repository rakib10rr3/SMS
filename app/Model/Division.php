<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public function districts(){
        return $this->hasMany(District::class);
    }
}
