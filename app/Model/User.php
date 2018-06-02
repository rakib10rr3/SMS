<?php

namespace App;

use App\Model\Notice;
use App\Model\Role;
use App\Model\Staff;
use App\Model\Student;
use App\Model\Teacher;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    /**
     * Return the user display name
     * @return string
     */
    public function getUserDisplayName()
    {
        $student = $this->student;
        $teacher = $this->teacher;
        $staff = $this->staff;

        if (!is_null($teacher)) {
            return $teacher->name;
        }

        if (!is_null($student)) {
            return $student->name;
        }

        if (!is_null($staff)) {
            return $staff->name;
        }

        return $this->username;
    }
}
