<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
