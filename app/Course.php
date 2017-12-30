<?php

namespace App;

use App\Transformers\CourseTransformer;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    public $transformer = CourseTransformer::class;

    protected $table = 'courses';

    public function students(){
        return $this->belongsToMany('App\Users', 'students_courses', 'course_id', 'student_id');
    }

    public function lecturer(){
        return $this->hasOne('App\User', 'id', 'lecturer_id' );
    }

    public function subject(){
        return $this->hasOne('App\Subject', 'id', 'subject_id');
    }
}
