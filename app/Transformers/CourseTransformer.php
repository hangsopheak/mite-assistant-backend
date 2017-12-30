<?php

namespace App\Transformers;

use App\Course;
use League\Fractal\TransformerAbstract;

class CourseTransformer extends TransformerAbstract
{
    public function transform(Course $course)
    {
        return [
            'id' => $course->id,
            'start_date' => $course->start_date,
            'end_date' => $course->end_date,
            'course_day' => $course->course_day,
            'course_time' => $course->course_time,
            'lecturer' => [
                'id' => $course->lecturer['id'],
                'name' => $course->lecturer['name'],
                'email' => $course->lecturer['email']
            ],
            'subject' => [
                'id' => $course->subject['id'],
                'name' => $course->subject['name'],
                'credit' => $course->subject['credit']
            ]
        ];
    }
}