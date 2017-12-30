<?php

namespace App\Services;
use DB;
use App\User;

class UserCourseService extends UserService
{
    public function getStudentCourses($id){
        $courses = User::find($id)->studentCourses()->with(['subject', 'lecturer'])->get();
        return $this->showAll($courses);
    }

}