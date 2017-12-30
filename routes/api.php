<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function() { 
	Route::get('users/{email}/by_email', 'v1\UserController@showByEmail');
	Route::get('users/{id}', 'v1\UserController@show');
	Route::post('users', 'v1\UserController@store');
	Route::post('users/login', 'v1\UserController@login');
	Route::put('users/{id}/otp', 'v1\SnUserController@resendOtp');
	Route::put('users/{id}/password', 'v1\SnUserController@changePassword');

    Route::get('lecturers', 'v1\LecturerController@index');
    Route::get('lecturers/{id}/courses', 'v1\LecturerCourseController@index');
    Route::get('lecturers/{id}/courses/{course_id}/students', 'v1\LecturerCourseStudentController@index');

    Route::get('students/{id}/courses', 'v1\StudentCourseController@index');

});




