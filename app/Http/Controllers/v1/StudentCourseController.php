<?php

namespace App\Http\Controllers\v1;

use App\Services\UserCourseService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class StudentCourseController extends Controller
{
    protected $userCourseService;

    public function __construct(UserCourseService $userCourseService)
    {
        $this->userCourseService = $userCourseService;
    }

    public function index($id, Request $request){
        return $this->userCourseService->getStudentCourses($id);
    }
}
