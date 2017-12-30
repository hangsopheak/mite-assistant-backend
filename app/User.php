<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\UserTransformer;

class User extends Model
{

    const ROLE_ADMIN = 1;
    const ROLE_LECTURER = 2;
    const ROLE_STUDENT = 3;

    public $timestamps = false;
    public $transformer = UserTransformer::class;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'role_id', 'profile_picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'created_on', 'created_by' , 'status', 'pivot'
    ];


    public function studentCourses()
    {
        return $this->belongsToMany('App\Course', 'students_courses', 'student_id', 'course_id');
    }

    public function lecturerCourses()
    {
        return $this->hasMany('Courses', 'id', 'lecturer_id');
    }
}
